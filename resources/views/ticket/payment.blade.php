<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Tiket - Rumah Ticket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

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

                    <div class="flex justify-between mb-3">
                        <span class="text-gray-600">Tiket</span>
                        <span class="font-semibold">VIP</span>
                    </div>

                    <div class="flex justify-between mb-3">
                        <span class="text-gray-600">Jumlah</span>
                        <span class="font-semibold">1 Tiket</span>
                    </div>

                    <div class="border-t border-primary-200 pt-3 mt-3 flex justify-between">
                        <span class="font-bold">Total Bayar</span>
                        <span class="font-bold text-primary-600">Rp500.000</span>
                    </div>
                </div>

                <!-- Upload Pembayaran -->
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label class="block font-semibold text-gray-700 mb-3">
                        Upload Bukti Pembayaran
                    </label>

                    <input 
                        type="file"
                        name="payment_proof"
                        accept="image/*"
                        class="w-full border border-primary-200 rounded-xl p-3 mb-6 
                        focus:outline-none focus:ring-2 focus:ring-primary-500"
                    >

                    <button
                        type="submit"
                        class="w-full bg-secondary-600 hover:bg-secondary-700 
                        text-white font-bold py-4 rounded-xl transition">
                        Kirim Pembayaran
                    </button>
                </form>

            </div>

        </div>

    </div>

    @include('components.footer')

</body>
</html>