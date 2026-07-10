<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket | Rumah Ticket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        @media print {

            html,
            body {
                width: 100%;
                height: 100%;
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            nav,
            footer,
            .no-print {
                display: none !important;
            }

            .max-w-6xl {
                max-width: 100% !important;
                margin: 0 auto !important;
                padding: 0 !important;
            }

            .ticket {
                width: 100% !important;
                max-width: 100% !important;
                box-shadow: none !important;
                border: 1px solid #d1d5db !important;
                border-radius: 24px !important;
                overflow: hidden;
                page-break-inside: avoid;
            }
        }
    </style>

</head>

<body class="bg-primary-50">

    @include('components.navbar')

    <div class="max-w-6xl mx-auto px-6 py-10">

        <div class="ticket bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-primary-700 px-8 py-6 flex justify-between items-center">

                <div>
                    <h1 class="text-3xl font-bold text-white">
                        E-Ticket
                    </h1>

                    <p class="text-primary-100 mt-1">
                        Rumah Ticket
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-primary-100 text-sm">
                        Ticket ID
                    </p>

                    <h2 class="text-2xl font-bold text-white">
                        TCK-20260710-001
                    </h2>
                </div>

            </div>

            <div class="grid lg:grid-cols-2">

                <!-- Kiri -->
                <div class="p-8">

                    <h2 class="text-2xl font-bold text-primary-700 mb-8">
                        Sheila On 7 Live Concert
                    </h2>

                    <div class="space-y-6">

                        <div>
                            <p class="text-gray-500 text-sm">
                                Jenis Tiket
                            </p>

                            <h3 class="font-semibold text-lg">
                                VIP
                            </h3>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Lokasi
                            </p>

                            <h3 class="font-semibold text-lg">
                                Stadion Kanjuruhan
                            </h3>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Tanggal Event
                            </p>

                            <h3 class="font-semibold text-lg">
                                25 Juli 2026
                            </h3>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Jam Event
                            </p>

                            <h3 class="font-semibold text-lg">
                                19.00 WIB
                            </h3>
                        </div>

                    </div>

                </div>

                <!-- Kanan -->
                <div class="bg-primary-50 border-l border-dashed border-primary-300 p-8 flex flex-col justify-between">

                    <div>

                        <div class="bg-white rounded-2xl border border-primary-200 p-6 text-center">

                            <h2 class="text-xl font-bold text-primary-700 mb-2">
                                Rumah Ticket
                            </h2>

                            <p class="text-gray-500">
                                Tiket ini berlaku untuk satu kali masuk.
                            </p>

                            <div class="mt-8">

                                <h3 class="text-5xl font-black tracking-[10px] text-primary-700">
                                    VIP
                                </h3>

                            </div>

                        </div>

                    </div>

                    <div class="mt-8">

                        <div class="bg-secondary-50 border border-secondary-200 rounded-xl p-4">

                            <p class="text-secondary-700 text-sm text-center">
                                Tunjukkan E-Ticket ini kepada petugas saat memasuki area event.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div class="bg-gray-50 border-t px-8 py-6 flex justify-end gap-4 no-print">

                <button type="button" onclick="downloadTicket()"
                    class="bg-secondary-600 hover:bg-secondary-700 text-white font-semibold px-6 py-3 rounded-xl transition">

                    Download Tiket

                </button>

                <a href="{{ route('ticket.invoice') }}"
                    class="bg-primary-700 hover:bg-primary-800 text-white font-semibold px-6 py-3 rounded-xl transition">

                    Kembali ke Invoice

                </a>

            </div>

        </div>

    </div>

    @include('components.footer')

    <script>
        function downloadTicket() {
            setTimeout(() => {
                window.print();
            }, 100);
        }
    </script>

</body>

</html>
