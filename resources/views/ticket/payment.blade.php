<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Tiket - Rumah Ticket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    @include('partials.guard-auth')

    @include('components.navbar')

    <div class="min-h-screen bg-primary-50 flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 p-8 text-white">
                <h1 class="text-3xl font-extrabold">
                    Pembelian Tiket
                </h1>

                <p class="mt-2 text-primary-100">
                    Upload bukti pembayaran untuk menyelesaikan pembelian
                </p>
            </div>

            <div class="p-8">

                <!-- Detail Ticket -->
                <div class="bg-primary-50 rounded-2xl p-5 mb-6">

                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        Detail Tiket
                    </h2>

                    <div id="ticketDetail"></div>

                    <div class="border-t border-primary-200 pt-3 mt-3 flex justify-between">
                        <span class="font-bold">Total Bayar</span>

                        <span class="font-bold text-primary-600" id="ticketTotal">
                            Rp0
                        </span>
                    </div>

                </div>

                <div id="alertError"
                    class="hidden mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
                </div>

                <!-- Upload -->
                <form id="paymentForm">

                    <label class="block font-semibold text-gray-700 mb-3">
                        Upload Bukti Pembayaran
                    </label>

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

    @include('components.footer')

    <script>
        const API_URL = '{{ config('global.api_url', 'http://localhost:8001/api') }}';
        const token = localStorage.getItem('token');

        // ==========================
        // AMBIL DATA DARI LOCAL STORAGE
        // ==========================

        const order = JSON.parse(localStorage.getItem('orderData'));

        if (order) {

            let html = "";

            if (order.vvip > 0) {
                html += `
        <div class="flex justify-between mb-2">
            <span>VVIP x${order.vvip}</span>
            <span>Rp ${(order.vvip * 750000).toLocaleString('id-ID')}</span>
        </div>`;
            }

            if (order.vip > 0) {
                html += `
        <div class="flex justify-between mb-2">
            <span>VIP x${order.vip}</span>
            <span>Rp ${(order.vip * 500000).toLocaleString('id-ID')}</span>
        </div>`;
            }

            if (order.regular > 0) {
                html += `
        <div class="flex justify-between mb-2">
            <span>Regular x${order.regular}</span>
            <span>Rp ${(order.regular * 250000).toLocaleString('id-ID')}</span>
        </div>`;
            }

            html += `
    <div class="flex justify-between mt-3">
        <span>Biaya Admin</span>
        <span>Rp 5.000</span>
    </div>`;

            document.getElementById("ticketDetail").innerHTML = html;

            document.getElementById("ticketTotal").textContent =
                "Rp " + Number(order.total).toLocaleString("id-ID");

        }

        // ==========================
        // SUBMIT PEMBAYARAN
        // ==========================

        document.getElementById('paymentForm').addEventListener('submit', async function(e) {

            e.preventDefault();

            const button = document.getElementById('submitBtn');
            const alertBox = document.getElementById('alertError');
            const fileInput = document.getElementById('paymentProof');

            alertBox.classList.add('hidden');
            alertBox.textContent = '';

            if (!fileInput.files[0]) {

                alertBox.textContent = 'Silakan pilih bukti pembayaran.';
                alertBox.classList.remove('hidden');

                return;
            }

            button.disabled = true;
            button.textContent = 'Mengirim...';

            const formData = new FormData();

            formData.append('payment_proof', fileInput.files[0]);

            if (order) {

                formData.append('vvip', order.vvip);
                formData.append('vip', order.vip);
                formData.append('regular', order.regular);
                formData.append('total_price', order.total);

            }

            try {

                const response = await fetch(`${API_URL}/order/payment-proof`, {

                    method: 'POST',

                    headers: {
                        Accept: 'application/json',
                        Authorization: `Bearer ${token}`,
                    },

                    body: formData

                });

                const data = await response.json();

                if (!response.ok) {

                    const message = data.errors ?
                        Object.values(data.errors).flat().join(' ') :
                        (data.message || 'Gagal mengirim bukti pembayaran.');

                    alertBox.textContent = message;
                    alertBox.classList.remove('hidden');

                    return;
                }

                localStorage.removeItem('orderData');

                window.location.href = "{{ route('ticket.invoice') }}";

            } catch (err) {

                alertBox.textContent = 'Tidak dapat terhubung ke server.';
                alertBox.classList.remove('hidden');

            } finally {

                button.disabled = false;
                button.textContent = 'Kirim Pembayaran';

            }

        });
    </script>

</body>

</html>
