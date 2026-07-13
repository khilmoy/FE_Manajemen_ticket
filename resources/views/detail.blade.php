<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event | Rumah Ticket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    @include('components.navbar')


    <main class="max-w-7xl mx-auto px-6 py-10">


        <!-- Banner -->
        <div class="h-[420px] rounded-3xl shadow-xl overflow-hidden relative border border-primary-100">

            <img src="{{ asset('assets/images/banner/dewa19.png') }}" alt="Dewa 19" class="w-full h-full object-cover">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/40"></div>

        </div>



        <div class="grid lg:grid-cols-3 gap-8 mt-10">


            <!-- LEFT -->
            <div class="lg:col-span-2">


                <span class="inline-flex px-4 py-1 rounded-full bg-primary-100 text-primary-700 font-semibold text-sm">
                    Musik
                </span>



                <h1 class="text-4xl font-bold mt-4 text-gray-800">
                    Dewa 19
                </h1>



                <div class="flex flex-wrap gap-8 mt-6 text-gray-600">

                    <div class="flex items-center gap-2">
                        📅
                        <span>17 November 2024</span>
                    </div>


                    <div class="flex items-center gap-2">
                        🕖
                        <span>21.00 WIB</span>
                    </div>


                    <div class="flex items-center gap-2">
                        📍
                        <span>Surabaya</span>
                    </div>

                </div>



                <!-- Deskripsi -->
                <div class="bg-white rounded-3xl shadow mt-10 p-8">

                    <h2 class="text-2xl font-bold mb-5">
                        Tentang Event
                    </h2>


                    <p class="leading-8 text-gray-600">

                        Dewa 19 kembali menggelar konser spektakuler pada tahun 2024.
                        Nikmati penampilan lagu-lagu hits legendaris seperti Kangen,
                        Roman Picisan, Risalah Hati, dan Pupus bersama ribuan Baladewa
                        dalam suasana yang meriah dan penuh nostalgia.

                    </p>

                </div>





                <!-- PILIH TIKET -->
                <div class="bg-white rounded-3xl shadow mt-8 p-8">


                    <h2 class="text-2xl font-bold mb-6">
                        Pilih Tiket
                    </h2>



                    <div class="space-y-5">

                        <!-- VVIP -->
                        <div class="border rounded-2xl p-6 hover:border-primary-500 transition">

                            <div class="flex justify-between items-center">


                                <div>

                                    <h3 class="text-xl font-bold">
                                        VVIP
                                    </h3>


                                    <p class="text-primary-700 text-2xl font-bold mt-2">
                                        Rp750.000
                                    </p>


                                    <p class="text-gray-500">
                                        Sisa 18 Tiket
                                    </p>


                                </div>



                                <div class="flex items-center gap-3">


                                    <button onclick="kurangTiket('vvip')"
                                        class="w-10 h-10 rounded-full border hover:bg-gray-100">
                                        -
                                    </button>


                                    <span id="vvip-count" class="font-bold text-lg">
                                        0
                                    </span>


                                    <button onclick="tambahTiket('vvip')"
                                        class="w-10 h-10 rounded-full bg-primary-600 text-white hover:bg-primary-700">
                                        +
                                    </button>


                                </div>


                            </div>

                        </div>

                        <!-- VIP -->
                        <div class="border rounded-2xl p-6 hover:border-primary-500 transition">

                            <div class="flex justify-between items-center">

                                <div>

                                    <h3 class="text-xl font-bold">
                                        VIP
                                    </h3>

                                    <p class="text-primary-700 text-2xl font-bold mt-2">
                                        Rp500.000
                                    </p>

                                    <p class="text-gray-500">
                                        Sisa 45 Tiket
                                    </p>

                                </div>

                                <div class="flex items-center gap-3">

                                    <button onclick="kurangTiket('vip')"
                                        class="w-10 h-10 rounded-full border hover:bg-gray-100">
                                        -
                                    </button>

                                    <span id="vip-count" class="font-bold text-lg">
                                        0
                                    </span>

                                    <button onclick="tambahTiket('vip')"
                                        class="w-10 h-10 rounded-full bg-primary-600 text-white hover:bg-primary-700">
                                        +
                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- REGULAR -->
                        <div class="border rounded-2xl p-6 hover:border-primary-500 transition">

                            <div class="flex justify-between items-center">

                                <div>

                                    <h3 class="text-xl font-bold">
                                        Regular
                                    </h3>

                                    <p class="text-primary-700 text-2xl font-bold mt-2">
                                        Rp250.000
                                    </p>

                                    <p class="text-gray-500">
                                        Sisa 150 Tiket
                                    </p>

                                </div>

                                <div class="flex items-center gap-3">

                                    <button onclick="kurangTiket('regular')"
                                        class="w-10 h-10 rounded-full border hover:bg-gray-100">
                                        -
                                    </button>

                                    <span id="regular-count" class="font-bold text-lg">
                                        0
                                    </span>

                                    <button onclick="tambahTiket('regular')"
                                        class="w-10 h-10 rounded-full bg-primary-600 text-white hover:bg-primary-700">
                                        +
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Syarat -->
                <div class="bg-white rounded-3xl shadow mt-8 p-8">

                    <h2 class="text-2xl font-bold mb-5">
                        Syarat & Ketentuan
                    </h2>

                    <ul class="space-y-3 text-gray-600 list-disc pl-5">

                        <li>
                            Tiket yang telah dibeli tidak dapat dikembalikan.
                        </li>

                        <li>
                            Harap membawa E-ticket saat memasuki venue.
                        </li>

                        <li>
                            Dilarang membawa makanan dan minuman dari luar.
                        </li>

                        <li>
                            Panitia berhak menolak pengunjung yang melanggar aturan.
                        </li>

                    </ul>

                </div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <div class="bg-white rounded-3xl shadow-xl p-8 sticky top-24">

                    <h2 class="text-2xl font-bold mb-6">
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-4">

                        <div class="flex justify-between">
                            <span>
                                VVIP x<span id="side-vvip">0</span>
                            </span>

                            <span id="price-vvip">
                                Rp0
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>
                                VIP x<span id="side-vip">0</span>
                            </span>

                            <span id="price-vip">
                                Rp0
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>
                                Regular x<span id="side-regular">0</span>
                            </span>

                            <span id="price-regular">
                                Rp0
                            </span>
                        </div>

                        <div class="border-t pt-4 flex justify-between">

                            <span>
                                Biaya Admin
                            </span>

                            <span>
                                Rp5.000
                            </span>

                        </div>

                        <div class="border-t pt-5 flex justify-between text-xl font-bold">

                            <span>
                                Total
                            </span>

                            <span id="total-price" class="text-primary-700">

                                Rp5.000

                            </span>


                        </div>

                    </div>

                    <button type="button" id="beliTiketBtn"
                        class="block text-center w-full mt-8 bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 rounded-xl transition">

                        Beli Tiket

                    </button>

                </div>

            </div>

        </div>

    </main>

    @include('components.footer')

    <script>
        document.getElementById('beliTiketBtn').addEventListener('click', function() {

            let jenis = '';
            let jumlah = 0;
            let total = 5000;

            if (window.tiket.vvip > 0) {
                jenis = 'VVIP';
                jumlah = window.tiket.vvip;
                total += window.tiket.vvip * window.harga.vvip;
            }

            if (window.tiket.vip > 0) {
                jenis = 'VIP';
                jumlah = window.tiket.vip;
                total += window.tiket.vip * window.harga.vip;
            }

            if (window.tiket.regular > 0) {
                jenis = 'Regular';
                jumlah = window.tiket.regular;
                total += window.tiket.regular * window.harga.regular;
            }

            if (jumlah === 0) {
                alert('Silakan pilih minimal 1 tiket.');
                return;
            }

            localStorage.setItem('orderData', JSON.stringify({
                vvip: tiket.vvip,
                vip: tiket.vip,
                regular: tiket.regular,
                total: total
            }));

            window.location.href = "{{ route('ticket.payment') }}";

        });
    </script>

</body>

</html>
