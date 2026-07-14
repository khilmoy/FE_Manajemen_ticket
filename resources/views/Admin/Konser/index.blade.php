@extends('layouts.app')

@section('title', 'Konser')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="header-title mb-1">Konser</h4>
                            <p class="text-muted mb-0">Kelola daftar konser beserta tiketnya.</p>
                        </div>

                        <a href="{{ route('konser.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus me-1"></i>
                            Tambah Konser
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-centered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th width="80">Image</th>
                                    <th>Nama Konser</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th width="240" class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($konsers as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if (!empty($item['image_url']))
                                                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" width="60"
                                                    height="60" style="object-fit: cover; border-radius: 8px;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                                    style="width:60px; height:60px;">
                                                    <i class="mdi mdi-image-off text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td><strong>{{ $item['name'] }}</strong></td>
                                        <td>{{ $item['kategori']['name'] ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['date'])->translatedFormat('d F Y') }}</td>
                                        <td>{{ $item['location'] }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('konser.show', $item['id']) }}"
                                                    class="btn btn-sm fw-semibold border-0 text-center"
                                                    style="min-width: 70px; background-color: rgba(41, 121, 255, 0.12); color: #2979ff; border-radius: 8px;">
                                                    <i class="mdi mdi-eye me-1"></i> Detail
                                                </a>

                                                <a href="{{ route('konser.edit', $item['id']) }}"
                                                    class="btn btn-sm fw-semibold border-0 text-center"
                                                    style="min-width: 70px; background-color: rgba(241, 180, 76, 0.12); color: #f1b44c; border-radius: 8px;">
                                                    <i class="mdi mdi-pencil me-1"></i> Edit
                                                </a>

                                                <form action="{{ route('konser.destroy', $item['id']) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus konser ini?');"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm fw-semibold border-0 text-center"
                                                        style="min-width: 70px; background-color: rgba(243, 79, 79, 0.12); color: #f34f4f; border-radius: 8px;">
                                                        <i class="mdi mdi-trash-can me-1"></i> Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= TABEL ORDER / KONFIRMASI PEMBAYARAN ================= -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="header-title mb-1">Konfirmasi Pembayaran</h4>
                            <p class="text-muted mb-0">Setujui atau tolak bukti pembayaran yang masuk.</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>User</th>
                                    <th>Konser</th>
                                    <th>Tiket</th>
                                    <th width="90" class="text-center">Qty</th>
                                    <th>Total</th>
                                    <th width="100">Bukti</th>
                                    <th width="130" class="text-center">Status</th>
                                    <th width="120" class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order['user']['name'] ?? '-' }}</td>
                                        <td>{{ $order['ticket']['konser']['name'] ?? '-' }}</td>
                                        <td>{{ $order['ticket']['ticket_name'] ?? '-' }}</td>
                                        <td class="text-center">{{ $order['quantity'] }}</td>
                                        <td>Rp{{ number_format($order['total_price'], 0, ',', '.') }}</td>
                                        <td>
                                            @if (!empty($order['image_url']))
                                                <a href="{{ $order['image_url'] }}" target="_blank">
                                                    <img src="{{ $order['image_url'] }}" width="50" height="50"
                                                        style="object-fit: cover; border-radius: 8px;">
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($order['status'] === 'pending')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @elseif ($order['status'] === 'approve')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($order['status'] === 'pending')
                                                <div class="d-flex justify-content-center gap-2">

                                                    <!-- Approve (centang) -->
                                                    <form action="{{ route('admin.order.approve', $order['id']) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Setujui pembayaran ini?');">
                                                        @csrf
                                                        <button type="submit"
                                                            title="Setujui"
                                                            class="btn btn-sm border-0 d-flex align-items-center justify-content-center"
                                                            style="width:36px; height:36px; background-color: rgba(40, 167, 69, 0.12); color: #28a745; border-radius: 8px;">
                                                            <i class="mdi mdi-check-bold fs-5"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Reject (silang) -->
                                                    <form action="{{ route('admin.order.reject', $order['id']) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Tolak pembayaran ini?');">
                                                        @csrf
                                                        <button type="submit"
                                                            title="Tolak"
                                                            class="btn btn-sm border-0 d-flex align-items-center justify-content-center"
                                                            style="width:36px; height:36px; background-color: rgba(220, 53, 69, 0.12); color: #dc3545; border-radius: 8px;">
                                                            <i class="mdi mdi-close-thick fs-5"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            @else
                                                <span class="text-muted small">Sudah diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Belum ada order masuk</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection