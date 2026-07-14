@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')

    <!-- ================= CAROUSEL ================= -->
    <section class="max-w-7xl mx-auto mt-8 px-4">

        <div class="relative overflow-hidden rounded-2xl shadow-xl">

            <!-- Slides -->
            <div class="relative h-100">

                @forelse ($banners as $index => $banner)
                    <div class="carousel-slide absolute inset-0 {{ $index !== 0 ? 'hidden' : '' }}">
                        <img src="{{ $banner['image_url'] }}" alt="{{ $banner['name'] }}" class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-black/40"></div>

                        <div class="absolute bottom-10 left-8 text-white">
                            <h3 class="text-2xl font-bold">{{ $banner['name'] }}</h3>
                            <p class="text-sm text-gray-200">{{ $banner['location'] }}</p>
                        </div>
                    </div>
                @empty
                    <div class="carousel-slide absolute inset-0">
                        <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                            <p class="text-primary-600 font-semibold">Belum ada konser tersedia</p>
                        </div>
                    </div>
                @endforelse

            </div>

            @if (count($banners) > 1)

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
                    @foreach ($banners as $index => $banner)
                        <button
                            class="carousel-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"></button>
                    @endforeach
                </div>

            @endif

        </div>

    </section>

    <!-- ================= EVENT ================= -->

    <section class="max-w-7xl mx-auto px-4 py-12">

        <!-- Header -->

        <div class="flex items-center justify-between mb-8">

            <div class="flex items-center gap-3">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Event Seru Untukmu
                    </h2>
                    <p class="text-gray-500 text-sm">
                        Temukan konser dan event terbaik di Indonesia.
                    </p>
                </div>

            </div>
        </div>

        <!-- Card -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse ($konsers as $konser)
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <!-- Image -->
                    <div class="h-48 border-b border-primary-100 overflow-hidden">
                        @if (!empty($konser['image_url']))
                            <img src="{{ $konser['image_url'] }}" alt="{{ $konser['name'] }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <i class="mdi mdi-image-off text-gray-400 text-3xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-5">

                        <span
                            class="inline-block bg-secondary-100 text-secondary-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $konser['kategori']['name'] ?? '-' }}
                        </span>

                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            {{ $konser['name'] }}
                        </h3>

                        <div class="mt-4 space-y-2 text-sm text-gray-500">

                            <div class="flex items-center gap-2">
                                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </span>
                                <span>{{ $konser['location'] }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                    </svg>
                                </span>
                                <span>{{ \Carbon\Carbon::parse($konser['date'])->translatedFormat('d F Y') }}</span>
                            </div>

                        </div>

                        <div class="flex justify-between items-end mt-6">

                            <div>
                                <p class="text-xs text-gray-400">
                                    Mulai dari
                                </p>
                                <h4 class="text-xl font-bold text-primary-700">
                                    @if (!empty($konser['harga_termurah']))
                                        Rp{{ number_format($konser['harga_termurah'], 0, ',', '.') }}
                                    @else
                                        Habis
                                    @endif
                                </h4>
                            </div>

                            <a href="{{ route('detail', $konser['id']) }}"
                                class="inline-block bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition">
                                Detail
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <p class="text-gray-500 col-span-4 text-center py-10">
                    Belum ada konser tersedia.
                </p>
            @endforelse

        </div>

    </section>

@endsection
