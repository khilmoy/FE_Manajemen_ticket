@extends('layouts.frontend')

@section('title', 'Invoice | Rumah Ticket')

@section('content')

    <div class="max-w-4xl mx-auto px-6 py-10">
        <div id="loading" class="text-center py-10 font-semibold text-gray-500">
            Sedang memuat data invoice...
        </div>

        <div id="invoiceContent" class="hidden bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="bg-primary-600 px-8 py-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Invoice Pemesanan</h1>
                    <p class="text-primary-100 mt-1">Rumah Ticket</p>
                </div>
                <div id="statusBadge"></div>
            </div>

            <div class="p-8 space-y-8">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-500 text-sm">Invoice ID</p>
                        <h3 class="font-semibold" id="invoiceId">INV-000000</h3>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal</p>
                        <h3 class="font-semibold" id="invoiceDate">-</h3>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Pemesanan</h2>
                    <div class="border border-primary-100 rounded-2xl divide-y">
                        <div class="flex justify-between px-5 py-4">
                            <span class="text-gray-600">Nama Event</span>
                            <span class="font-medium" id="eventName">-</span>
                        </div>
                        <div class="flex justify-between px-5 py-4">
                            <span class="text-gray-600">Kategori Tiket</span>
                            <span class="font-medium" id="ticketName">-</span>
                        </div>
                        <div class="flex justify-between px-5 py-4">
                            <span class="text-gray-600">Jumlah Tiket</span>
                            <span class="font-medium" id="ticketQty">0 Tiket</span>
                        </div>
                        <div class="flex justify-between px-5 py-4 bg-primary-50">
                            <span class="font-bold">Total Pembayaran</span>
                            <span class="font-bold text-primary-700" id="totalPrice">Rp0</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Bukti Pembayaran</h2>
                    <div class="border border-primary-100 rounded-2xl p-4">
                        <img id="paymentImg" src="" alt="Bukti Pembayaran" class="rounded-xl w-full max-h-96 object-contain">
                    </div>
                </div>

                <div id="statusBox" class="rounded-2xl p-5"></div>

                <div class="flex justify-end gap-4">
                    <a id="btnETicket" href="#" class="hidden bg-secondary-600 hover:bg-secondary-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Lihat E-Ticket
                    </a>
                    <a href="{{ route('home') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/auth-guard.js'])

    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const token = requireAuth('/order/{{ $id }}');
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
                    if (res.status === 401) {
                        alert("Sesi Anda habis. Silakan login kembali.");
                        window.location.href = "{{ route('login') }}";
                        return;
                    }
                    throw new Error("Gagal mengambil data invoice.");
                }

                const data = await res.json();
                
                document.getElementById('invoiceId').textContent = 'INV-' + String(data.id).padStart(6, '0');
                document.getElementById('invoiceDate').textContent = new Date(data.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                document.getElementById('eventName').textContent = data.ticket?.konser?.name || '-';
                document.getElementById('ticketName').textContent = data.ticket?.ticket_name || '-';
                document.getElementById('ticketQty').textContent = `${data.quantity} Tiket`;
                document.getElementById('totalPrice').textContent = 'Rp' + Number(data.total_price).toLocaleString('id-ID');
                
                const baseStorageUrl = apiUrl.replace('/api', '');
                document.getElementById('paymentImg').src = `${baseStorageUrl}/storage/${data.image}`;

                const badge = document.getElementById('statusBadge');
                const box = document.getElementById('statusBox');
                const btnETicket = document.getElementById('btnETicket');

                if (data.status === 'pending') {
                    badge.innerHTML = `<span class="bg-yellow-100 text-yellow-800 font-semibold px-4 py-2 rounded-full">Menunggu Verifikasi</span>`;
                    box.className = "bg-yellow-50 border border-yellow-200 rounded-2xl p-5";
                    box.innerHTML = `<h3 class="font-bold text-yellow-700 mb-2">Pembayaran Berhasil Dikirim</h3><p class="text-yellow-700">Bukti pembayaran telah berhasil diunggah. Sedang menunggu verifikasi admin.</p>`;
                } else if (data.status === 'approve') {
                    badge.innerHTML = `<span class="bg-green-100 text-green-800 font-semibold px-4 py-2 rounded-full">Approved</span>`;
                    box.className = "bg-green-50 border border-green-200 rounded-2xl p-5";
                    box.innerHTML = `<h3 class="font-bold text-green-700 mb-2">Pembayaran Disetujui</h3><p class="text-green-700">Pembayaran Anda terverifikasi. Silakan klik tombol di bawah untuk melihat E-Ticket.</p>`;
                    
                    btnETicket.href = `/order/${data.id}/e-ticket`;
                    btnETicket.classList.remove('hidden');
                } else {
                    badge.innerHTML = `<span class="bg-red-100 text-red-800 font-semibold px-4 py-2 rounded-full">Ditolak</span>`;
                    box.className = "bg-red-50 border border-red-200 rounded-2xl p-5";
                    box.innerHTML = `<h3 class="font-bold text-red-700 mb-2">Pembayaran Ditolak</h3><p class="text-red-700">Maaf, bukti pembayaran Anda ditolak oleh admin.</p>`;
                }

                document.getElementById('loading').classList.add('hidden');
                document.getElementById('invoiceContent').classList.remove('hidden');

            } catch (err) {
                document.getElementById('loading').textContent = err.message;
            }
        });
    </script>
@endsection