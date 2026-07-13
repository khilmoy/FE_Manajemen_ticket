@extends('layouts.frontend')

@section('title', 'Invoice | Rumah Ticket')

@section('content')

    @php
        // Ubah untuk mencoba tampilan
        $status = 'approved'; // 'open', 'in_progress', 'approved'
        // $status = 'in_progress';
        // $status = 'approved';
    @endphp

    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-primary-600 px-8 py-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">
                        Invoice Pemesanan
                    </h1>
                    <p class="text-primary-100 mt-1">
                        Rumah Ticket
                    </p>
                </div>

                <!-- Status -->
                @if ($status == 'open')
                    <span class="bg-yellow-100 text-yellow-800 font-semibold px-4 py-2 rounded-full">
                        Open
                    </span>
                @elseif($status == 'in_progress')
                    <span class="bg-blue-100 text-blue-800 font-semibold px-4 py-2 rounded-full">
                        In Progress
                    </span>
                @elseif($status == 'approved')
                    <span class="bg-green-100 text-green-800 font-semibold px-4 py-2 rounded-full">
                        Approved
                    </span>
                @endif

            </div>

            <div class="p-8 space-y-8">

                <!-- Informasi Invoice -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-500 text-sm">
                            Invoice ID
                        </p>

                        <h3 class="font-semibold">
                            INV-20260710-001
                        </h3>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">
                            Tanggal
                        </p>

                        <h3 class="font-semibold">
                            10 Juli 2026
                        </h3>
                    </div>

                </div>

                <!-- Detail Pemesanan -->
                <div>

                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        Detail Pemesanan
                    </h2>

                    <div class="border border-primary-100 rounded-2xl divide-y">

                        <div class="flex justify-between px-5 py-4">
                            <span class="text-gray-600">
                                Nama Event
                            </span>

                            <span class="font-medium">
                                Sheila On 7 Live Concert
                            </span>
                        </div>

                        <div class="flex justify-between px-5 py-4">
                            <span class="text-gray-600">
                                Kategori Tiket
                            </span>

                            <span class="font-medium">
                                VIP
                            </span>
                        </div>

                        <div class="flex justify-between px-5 py-4">
                            <span class="text-gray-600">
                                Jumlah Tiket
                            </span>

                            <span class="font-medium">
                                2 Tiket
                            </span>
                        </div>

                        <div class="flex justify-between px-5 py-4 bg-primary-50">
                            <span class="font-bold">
                                Total Pembayaran
                            </span>

                            <span class="font-bold text-primary-700">
                                Rp1.000.000
                            </span>
                        </div>

                    </div>

                </div>

                <!-- Bukti Pembayaran -->
                <div>

                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        Bukti Pembayaran
                    </h2>

                    <div class="border border-primary-100 rounded-2xl p-4">

                        <img src="{{ asset('assets/images/bukti.jpg') }}" alt="Bukti Pembayaran"
                            class="rounded-xl w-full max-h-96 object-contain">

                    </div>

                </div>

                <!-- Informasi Status -->
                @if ($status == 'open')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-5">

                        <h3 class="font-bold text-yellow-700 mb-2">
                            Pembayaran Berhasil Dikirim
                        </h3>

                        <p class="text-yellow-700">
                            Bukti pembayaran telah berhasil diunggah.
                            Pembayaran Anda sedang menunggu admin untuk memulai proses verifikasi.
                        </p>

                    </div>
                @elseif($status == 'in_progress')
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5">

                        <h3 class="font-bold text-blue-700 mb-2">
                            Pembayaran Sedang Diverifikasi
                        </h3>

                        <p class="text-blue-700">
                            Admin sedang memverifikasi bukti pembayaran Anda.
                            Mohon menunggu hingga proses selesai.
                        </p>

                    </div>
                @elseif($status == 'approved')
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-5">

                        <h3 class="font-bold text-green-700 mb-2">
                            Pembayaran Disetujui
                        </h3>

                        <p class="text-green-700">
                            Pembayaran Anda telah berhasil diverifikasi.
                            Silakan melihat E-Ticket Anda.
                        </p>

                    </div>
                @endif

                <!-- Tombol -->
                <div class="flex justify-end gap-4">

                    @if ($status == 'approved')
                        <a href="{{ route('ticket.e-ticket') }}"
                            class="bg-secondary-600 hover:bg-secondary-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                            Lihat E-Ticket
                        </a>
                    @endif

                    <a href="{{ route('home') }}"
                        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Kembali ke Beranda
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection