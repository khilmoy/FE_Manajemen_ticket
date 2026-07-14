@extends('layouts.frontend')

@section('title', 'E-Ticket | Rumah Ticket')

@section('content')
    <div class="max-w-2xl mx-auto px-6 py-10">
        <div id="loading" class="text-center py-10 font-semibold text-gray-500">
            Sedang memuat data E-Ticket...
        </div>

        <div id="ticketContent" class="hidden bg-white rounded-3xl shadow-xl overflow-hidden border-2 border-dashed border-gray-200">
            <div class="bg-secondary-600 px-8 py-6 text-center text-white">
                <h1 class="text-3xl font-bold tracking-wider">OFFICIAL E-TICKET</h1>
                <p class="text-secondary-100 mt-1" id="ticketCode">Loading...</p>
            </div>

            <div class="p-8 space-y-6">
                <div class="text-center border-b pb-6">
                    <h2 class="text-2xl font-bold text-gray-800" id="eventName">-</h2>
                    <p class="text-gray-500 mt-1 font-medium text-lg" id="ticketName">-</p>
                </div>

                <div class="grid grid-cols-2 gap-6 text-sm border-b pb-6">
                    <div>
                        <p class="text-gray-400 uppercase tracking-wider text-xs">Nama Pembeli</p>
                        <p class="font-semibold text-gray-700 text-base mt-0.5" id="userName">-</p>
                    </div>
                    <div>
                        <p class="text-gray-400 uppercase tracking-wider text-xs">Jumlah Tiket</p>
                        <p class="font-semibold text-gray-700 text-base mt-0.5" id="ticketQty">0 Tiket</p>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center py-4 bg-gray-50 rounded-2xl">
                    <div class="p-4 bg-white rounded-xl shadow-sm border">
                        <div class="w-48 h-48 bg-gray-200 flex items-center justify-center font-mono text-gray-400 text-xs text-center p-4 rounded-lg">
                            [ QR CODE VALIDATION ]
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-3 font-mono" id="barcodeId">INV-000000</p>
                </div>

                <div class="flex gap-4">
                    <a href="/order/{{ $id }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-xl transition">
                        Kembali ke Invoice
                    </a>
                    <button onclick="window.print()" class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Cetak / Simpan PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/auth-guard.js'])

    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const token = requireAuth('/order/{{ $id }}/e-ticket');
            if (!token) return;

            const apiUrl = "{{ config('global.api_url', 'http://localhost:8001/api') }}";
            const orderId = "{{ $id }}";

            try {
                const res = await fetch(`${apiUrl}/orders/${orderId}`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!res.ok) {
                    throw new Error("Gagal memuat data E-Ticket.");
                }

                const data = await res.json();

                if (data.status !== 'approve') {
                    alert("Akses Ditolak: E-Ticket hanya tersedia untuk pesanan yang sudah disetujui admin.");
                    window.location.href = `/order/${orderId}`;
                    return;
                }

                document.getElementById('ticketCode').textContent = `BOOKING ID: RTX-${String(data.id).padStart(6, '0')}`;
                document.getElementById('eventName').textContent = data.ticket?.konser?.name || '-';
                document.getElementById('ticketName').textContent = data.ticket?.ticket_name || '-';
                
                const userSession = JSON.parse(localStorage.getItem('user'));
                document.getElementById('userName').textContent = userSession?.name || 'Customer';
                
                document.getElementById('ticketQty').textContent = `${data.quantity} Tiket`;
                document.getElementById('barcodeId').textContent = `INV-${String(data.id).padStart(6, '0')} - CONFIRMED`;

                document.getElementById('loading').classList.add('hidden');
                document.getElementById('ticketContent').classList.remove('hidden');

            } catch (err) {
                document.getElementById('loading').textContent = err.message;
            }
        });
    </script>
@endsection