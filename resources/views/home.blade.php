<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Ticket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <x-navbar />

    <!-- ================= CAROUSEL ================= -->
    <section class="max-w-7xl mx-auto mt-8 px-4">

        <div class="relative overflow-hidden rounded-2xl shadow-xl">

            <!-- Slides -->
            <div class="relative h-[400px]">

                <div
                    class="carousel-slide absolute inset-0 flex items-center justify-center bg-linear-to-r from-primary-500 to-primary-700">
                    <h1 class="text-4xl md:text-5xl font-bold text-white">
                        Banner Event 1
                    </h1>
                </div>

                <div
                    class="carousel-slide absolute inset-0 hidden flex items-center justify-center bg-linear-to-r  from-primary-500 to-primary-700">
                    <h1 class="text-4xl md:text-5xl font-bold text-white">
                        Banner Event 2
                    </h1>
                </div>

                <div
                    class="carousel-slide absolute inset-0 hidden flex items-center justify-center bg-linear-to-r  from-primary-500 to-primary-700"">
                    <h1 class="text-4xl md:text-5xl font-bold text-white">
                        Banner Event 3
                    </h1>
                </div>

            </div>

            <!-- Prev -->
            <button
                class="carousel-prev absolute left-5 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-3 shadow-lg transition">

                <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                </svg>

            </button>

            <!-- Next -->
            <button
                class="carousel-next absolute right-5 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-3 shadow-lg transition">

                <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                </svg>

            </button>

            <!-- Dots -->
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-3 z-10">

                <button class="carousel-dot w-3 h-3 rounded-full bg-white"></button>

                <button class="carousel-dot w-3 h-3 rounded-full bg-white/50"></button>

                <button class="carousel-dot w-3 h-3 rounded-full bg-white/50"></button>

            </div>

        </div>

    </section>

    <!-- ================= EVENT ================= -->

    <section class="max-w-7xl mx-auto px-4 py-12">

        <!-- Header -->

        <div class="flex items-center justify-between mb-8">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-full bg-primary-100 flex items-center justify-center">

                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />

                    </svg>

                </div>

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Event Seru Untukmu
                    </h2>

                    <p class="text-gray-500 text-sm">
                        Temukan konser dan event terbaik di Indonesia.
                    </p>

                </div>

            </div>

            <button class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-xl transition">

                Lihat Semua

            </button>

        </div>

        <!-- Card -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @for ($i = 1; $i <= 8; $i++)
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <!-- Placeholder Image -->

                    <div class="h-48 bg-primary-50 border-b border-primary-100 flex items-center justify-center">

                        <span class="text-primary-300 font-medium">
                            Gambar Event
                        </span>

                    </div>

                    <!-- Content -->

                    <div class="p-5">

                        <span
                            class="inline-block bg-secondary-100 text-secondary-700 text-xs font-semibold px-3 py-1 rounded-full">

                            Musik

                        </span>

                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            Konser Musik Indonesia {{ $i }}
                        </h3>

                        <div class="mt-4 space-y-2 text-sm text-gray-500">

                            <div class="flex items-center gap-2">

                                <span>📍</span>

                                <span>Jakarta Selatan</span>

                            </div>

                            <div class="flex items-center gap-2">

                                <span>📅</span>

                                <span>28 Juli 2026</span>

                            </div>

                            <div class="flex items-center gap-2">
                                🕖
                                <span>19.00 WIB</span>
                            </div>

                        </div>

                        <div class="flex justify-between items-end mt-6">

                            <div>

                                <p class="text-xs text-gray-400">
                                    Mulai dari
                                </p>

                                <h4 class="text-xl font-bold text-primary-700">
                                    Rp150.000
                                </h4>

                            </div>

                            <a href="{{ route('detail') }}"
                                class="inline-block bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition">
                                Detail
                            </a>

                        </div>

                    </div>

                </div>
            @endfor

        </div>

    </section>

    <x-footer />

</body>

</html>
