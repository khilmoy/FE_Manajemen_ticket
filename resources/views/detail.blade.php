@extends('layouts.frontend')

@section('title', $konser->name . ' | Rumah Ticket')

@section('content')

    <main class="max-w-7xl mx-auto px-6 py-10">

        <!-- Banner -->
        <div class="h-105 rounded-3xl shadow-xl overflow-hidden relative border border-primary-100">

            <img src="{{ asset('assets/images/banner/dewa19.png') }}" alt="{{ $konser->name }}"
                class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/40"></div>

        </div>

        <div class="grid lg:grid-cols-3 gap-8 mt-10">

            <!-- LEFT -->
            <div class="lg:col-span-2">

                <span class="inline-flex px-4 py-1 rounded-full bg-primary-100 text-primary-700 font-semibold text-sm">
                    {{ $konser->kategori->name ?? '-' }}
                </span>

                <h1 class="text-4xl font-bold mt-4 text-gray-800">
                    {{ $konser->name }}
                </h1>

                <div class="flex flex-wrap gap-8 mt-6 text-gray-600">

                    <div class="flex items-center gap-2">
                        📅
                        <span>{{ \Carbon\Carbon::parse($konser->date)->translatedFormat('d F Y') }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        📍
                        <span>{{ $konser->location }}</span>
                    </div>

                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-3xl shadow mt-10 p-8">

                    <h2 class="text-2xl font-bold mb-5">
                        Tentang Event
                    </h2>

                    <p class="leading-8 text-gray-600">
                        {{ $konser->description ?? 'Belum ada deskripsi untuk event ini.' }}
                    </p>

                </div>

                <!-- PILIH TIKET -->
                <div class="bg-white rounded-3xl shadow mt-8 p-8">

                    <h2 class="text-2xl font-bold mb-6">
                        Pilih Tiket
                    </h2>

                    <div class="space-y-5">

                        @forelse ($konser->tickets as $ticket)
                            <div class="border rounded-2xl p-6 hover:border-primary-500 transition">

                                <div class="flex justify-between items-center">

                                    <div>
                                        <h3 class="text-xl font-bold text-capitalize">{{ ucfirst($ticket->ticket_name) }}
                                        </h3>
                                        <p class="text-primary-700 text-2xl font-bold mt-2">
                                            Rp{{ number_format($ticket->price, 0, ',', '.') }}
                                        </p>
                                        <p class="text-gray-500">Sisa {{ $ticket->stock }} Tiket</p>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <button onclick="kurangTiket({{ $ticket->id }})"
                                            class="w-10 h-10 rounded-full border hover:bg-gray-100">-</button>
                                        <span id="tiket-{{ $ticket->id }}-count" class="font-bold text-lg">0</span>
                                        <button onclick="tambahTiket({{ $ticket->id }})"
                                            class="w-10 h-10 rounded-full bg-primary-600 text-white hover:bg-primary-700">+</button>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Tiket belum tersedia untuk event ini.</p>
                        @endforelse

                    </div>

                </div>

                <!-- Syarat -->
                <div class="bg-white rounded-3xl shadow mt-8 p-8">

                    <h2 class="text-2xl font-bold mb-5">
                        Syarat & Ketentuan
                    </h2>

                    <ul class="space-y-3 text-gray-600 list-disc pl-5">
                        <li>Tiket yang telah dibeli tidak dapat dikembalikan.</li>
                        <li>Harap membawa E-ticket saat memasuki venue.</li>
                        <li>Dilarang membawa makanan dan minuman dari luar.</li>
                        <li>Panitia berhak menolak pengunjung yang melanggar aturan.</li>
                    </ul>

                </div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <div class="bg-white rounded-3xl shadow-xl p-8 sticky top-24">

                    <h2 class="text-2xl font-bold mb-6">
                        Ringkasan Pesanan
                    </h2>

                    <div id="ringkasan-list" class="space-y-4">

                        @foreach ($konser->tickets as $ticket)
                            <div class="flex justify-between">
                                <span>{{ ucfirst($ticket->ticket_name) }} x<span
                                        id="side-{{ $ticket->id }}">0</span></span>
                                <span id="price-{{ $ticket->id }}">Rp0</span>
                            </div>
                        @endforeach

                        <div class="border-t pt-4 flex justify-between">
                            <span>Biaya Admin</span>
                            <span>Rp5.000</span>
                        </div>

                        <div class="border-t pt-5 flex justify-between text-xl font-bold">
                            <span>Total</span>
                            <span id="total-price" class="text-primary-700">Rp5.000</span>
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

    <script>
        // Harga tiket
        window.harga = {
            @foreach ($konser->tickets as $ticket)
                {{ $ticket->id }}: {{ $ticket->price }},
            @endforeach
        };

        // Nama tiket
        window.nama = {
            @foreach ($konser->tickets as $ticket)
                {{ $ticket->id }}: "{{ $ticket->ticket_name }}",
            @endforeach
        };

        // Jumlah tiket yang dipilih
        window.tiket = {
            @foreach ($konser->tickets as $ticket)
                {{ $ticket->id }}: 0,
            @endforeach
        };

        function updateSidebar() {
            let total = 5000;

            for (const id in window.tiket) {

                const qty = window.tiket[id];
                const harga = window.harga[id];

                document.getElementById('side-' + id).textContent = qty;

                document.getElementById('price-' + id).textContent =
                    'Rp' + (qty * harga).toLocaleString('id-ID');

                total += qty * harga;
            }

            document.getElementById('total-price').textContent =
                'Rp' + total.toLocaleString('id-ID');
        }

        window.tambahTiket = function(id) {
            window.tiket[id]++;

            document.getElementById('tiket-' + id + '-count').textContent =
                window.tiket[id];

            updateSidebar();
        }

        window.kurangTiket = function(id) {
            if (window.tiket[id] > 0) {

                window.tiket[id]--;

                document.getElementById('tiket-' + id + '-count').textContent =
                    window.tiket[id];

                updateSidebar();
            }
        }

        document.getElementById('beliTiketBtn').addEventListener('click', function() {
            const selected = Object.entries(window.tiket).filter(([, qty]) => qty > 0);

            if (selected.length === 0) {
                alert('Pilih minimal 1 tiket terlebih dahulu.');
                return;
            }

            if (selected.length > 1) {
                alert('Saat ini pembelian hanya bisa untuk satu jenis tiket dalam satu transaksi.');
                return;
            }

            const [ticketId, qty] = selected[0];

            const orderData = {
                ticket_id: Number(ticketId),
                ticket_name: window.nama[ticketId],
                price: window.harga[ticketId],
                qty: Number(qty),
            };

            localStorage.setItem('orderData', JSON.stringify(orderData));

            window.location.href = "{{ route('ticket.payment') }}";
        });
    </script>
@endsection
