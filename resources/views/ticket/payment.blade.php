@extends('layouts.frontend')

@section('title', 'Pembelian Tiket - Rumah Ticket')

@section('content')

    <div class="min-h-screen bg-primary-50 flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-linear-to-r from-primary-600 to-primary-700 p-8 text-white">
                <h1 class="text-3xl font-extrabold">Pembelian Tiket</h1>
                <p class="mt-2 text-primary-100">Upload bukti pembayaran untuk menyelesaikan pembelian</p>
            </div>

            <div class="p-8">
                <!-- Detail Ticket -->
                <div class="bg-primary-50 rounded-2xl p-5 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Tiket</h2>

                    <div id="ticketDetail"></div>

                    <div class="border-t border-primary-200 pt-3 mt-3 flex justify-between">
                        <span class="font-bold">Total Bayar</span>
                        <span class="font-bold text-primary-600" id="ticketTotal">Rp0</span>
                    </div>
                </div>

                <!-- Alert -->
                <div id="alertError" class="hidden mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600"></div>

                <!-- Upload -->
                <form id="paymentForm">
                    <label class="block font-semibold text-gray-700 mb-3">Upload Bukti Pembayaran</label>

                    <input type="file" id="paymentProof" name="payment_proof" accept="image/*" required
                        class="w-full border border-primary-200 rounded-xl p-3 mb-6 focus:outline-none focus:ring-2 focus:ring-primary-500">

                    <button type="submit" id="submitBtn"
                        class="w-full bg-secondary-600 hover:bg-secondary-700 text-white font-bold py-4 rounded-xl transition disabled:opacity-60 disabled:cursor-not-allowed">
                        Kirim Pembayaran
                    </button>
                </form>
            </div>

        </div>
    </div>

    @vite(['resources/js/auth-guard.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            window.API_URL = "{{ config('global.api_url', 'http://localhost:8001/api') }}";

            const token = requireAuth('/beli-ticket');

            if (!token) {
                return;
            }

            let orderData = null;
            try {
                orderData = JSON.parse(localStorage.getItem('orderData'));
            } catch (e) {
                orderData = null;
            }

            if (!orderData || !orderData.ticket_id || !orderData.qty) {
                window.location.href = "{{ route('home') }}";
                return;
            }

            function renderTicketSummary() {
                const subtotal = orderData.price * orderData.qty;

                document.getElementById('ticketDetail').innerHTML = `
                    <div class="flex justify-between mb-2">
                        <span>${orderData.ticket_name} x${orderData.qty}</span>
                        <span>Rp${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                `;

                document.getElementById('ticketTotal').textContent =
                    'Rp' + subtotal.toLocaleString('id-ID');
            }

            renderTicketSummary();

            document.getElementById('paymentForm').addEventListener('submit', async function (e) {
                e.preventDefault();

                const fileInput = document.getElementById('paymentProof');
                const submitBtn = document.getElementById('submitBtn');
                const alertBox = document.getElementById('alertError');

                alertBox.classList.add('hidden');

                if (!fileInput.files.length) {
                    alertBox.textContent = 'Silakan pilih bukti pembayaran.';
                    alertBox.classList.remove('hidden');
                    return;
                }

                const formData = new FormData();
                formData.append('ticket_id', orderData.ticket_id);
                formData.append('quantity', orderData.qty);
                formData.append('image', fileInput.files[0]);

                submitBtn.disabled = true;
                submitBtn.textContent = 'Mengirim...';

                try {
                    const res = await fetch(`${window.API_URL}/orders`, {
                        method: 'POST',
                        headers: {
                            Authorization: `Bearer ${token}`,
                            Accept: 'application/json',
                        },
                        body: formData,
                    });

                    const data = await res.json();

                    if (!res.ok) {
                        throw new Error(data.message || 'Gagal mengirim pembayaran.');
                    }

                    localStorage.removeItem('orderData');
                    window.location.href = `/order/${data.id}`;
                } catch (err) {
                    alertBox.textContent = err.message;
                    alertBox.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Kirim Pembayaran';
                }
            });

        });
    </script>

@endsection