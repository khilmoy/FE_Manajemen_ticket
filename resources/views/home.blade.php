@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')

    <!-- ================= CAROUSEL ================= -->
    <section class="max-w-7xl mx-auto mt-8 px-4">

        <div class="relative overflow-hidden rounded-2xl shadow-xl">

            <!-- Slides -->
            <div class="relative h-100">

                <div class="carousel-slide absolute inset-0">
                    <img src="{{ asset('assets/images/banner/dewa19.png') }}" alt="Dewa 19"
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <div class="carousel-slide absolute inset-0 hidden">
                    <img src="{{ asset('assets/images/banner/hindia.png') }}" alt="Hindia"
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <div class="carousel-slide absolute inset-0 hidden">
                    <img src="{{ asset('assets/images/banner/salpriadi.png') }}" alt="Sal Priadi"
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/40"></div>
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

            @forelse ($konsers as $konser)

                @php
                    $hargaTermurah = $konser->tickets->first();
                @endphp

                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <!-- Image -->

                    <div class="h-48 border-b border-primary-100 overflow-hidden">

                        <img src="{{ asset('assets/images/banner/dewa19.png') }}" alt="{{ $konser->name }}"
                            class="w-full h-full object-cover">

                    </div>

                    <!-- Content -->

                    <div class="p-5">

                        <span
                            class="inline-block bg-secondary-100 text-secondary-700 text-xs font-semibold px-3 py-1 rounded-full">

                            {{ $konser->kategori->name ?? '-' }}

                        </span>

                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            {{ $konser->name }}
                        </h3>

                        <div class="mt-4 space-y-2 text-sm text-gray-500">

                            <div class="flex items-center gap-2">

                                <span>📍</span>

                                <span>{{ $konser->location }}</span>

                            </div>

                            <div class="flex items-center gap-2">

                                <span>📅</span>

                                <span>{{ \Carbon\Carbon::parse($konser->date)->translatedFormat('d F Y') }}</span>

                            </div>

                        </div>

                        <div class="flex justify-between items-end mt-6">

                            <div>

                                <p class="text-xs text-gray-400">
                                    Mulai dari
                                </p>

                                <h4 class="text-xl font-bold text-primary-700">
                                    @if($hargaTermurah)
                                        Rp{{ number_format($hargaTermurah->price, 0, ',', '.') }}
                                    @else
                                        Habis
                                    @endif
                                </h4>

                            </div>

                            <a href="{{ route('detail', $konser->id) }}"
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