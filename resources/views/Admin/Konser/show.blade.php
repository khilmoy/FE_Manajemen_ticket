@extends('layouts.app')

@section('title', 'Detail Konser')

@section('content')

<div class="row">
   <div class="col-12">

      <div class="card mb-4">
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
               <div>
                  <h4 class="header-title mb-1">{{ $konser['name'] }}</h4>
                  <p class="text-muted mb-1">{{ $konser['kategori']['name'] ?? '-' }}</p>
                  <p class="mb-0">{{ \Carbon\Carbon::parse($konser['date'])->translatedFormat('d F Y') }} — {{ $konser['location'] }}</p>
                  @if ($konser['description'])
                     <p class="text-muted mt-2">{{ $konser['description'] }}</p>
                  @endif
               </div>
               <a href="{{ route('konser.edit', $konser['id']) }}" class="btn btn-sm btn-outline-warning">
                  <i class="mdi mdi-pencil me-1"></i> Edit Konser
               </a>
            </div>
         </div>
      </div>

      @if (session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
         <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <div class="card">
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
               <h5 class="mb-0">Tiket untuk Konser Ini</h5>
               <a href="{{ route('konser.ticket.create', $konser['id']) }}" class="btn btn-primary btn-sm">
                  <i class="mdi mdi-plus me-1"></i> Tambah Tiket
               </a>
            </div>

            <div class="table-responsive">
               <table class="table table-hover table-centered align-middle mb-0">
                  <thead class="table-light">
                     <tr>
                        <th width="50">No</th>
                        <th>Nama Tiket</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="180" class="text-center">Aksi</th>
                     </tr>
                  </thead>

                  <tbody>
                     @forelse ($tickets as $index => $item)
                        <tr>
                           <td>{{ $index + 1 }}</td>
                           <td><strong>{{ $item['ticket_name'] }}</strong></td>
                           <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                           <td>{{ $item['stock'] }}</td>
                           <td>
                              <span class="badge {{ $item['status'] === 'available' ? 'bg-success' : 'bg-secondary' }}">
                                 {{ $item['status'] === 'available' ? 'Tersedia' : 'Habis' }}
                              </span>
                           </td>
                           <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">

                                 <a href="{{ route('konser.ticket.edit', [$konser['id'], $item['id']]) }}"
                                    class="btn btn-sm d-inline-flex align-items-center px-3 py-1.5 fw-semibold border-0"
                                    style="background-color: rgba(241, 180, 76, 0.12); color: #f1b44c; border-radius: 8px;">
                                    <i class="mdi mdi-pencil me-1"></i> Edit
                                 </a>

                                 <form action="{{ route('konser.ticket.destroy', [$konser['id'], $item['id']]) }}"
                                       method="POST"
                                       onsubmit="return confirm('Yakin ingin menghapus tiket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                       class="btn btn-sm d-inline-flex align-items-center px-3 py-1.5 fw-semibold border-0"
                                       style="background-color: rgba(243, 79, 79, 0.12); color: #f34f4f; border-radius: 8px;">
                                       <i class="mdi mdi-trash-can me-1"></i> Hapus
                                    </button>
                                 </form>

                              </div>
                           </td>
                        </tr>
                     @empty
                        <tr>
                           <td colspan="6" class="text-center text-muted">Belum ada tiket untuk konser ini</td>
                        </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <a href="{{ route('konser.index') }}" class="btn btn-light mt-3">← Kembali ke Daftar Konser</a>

   </div>
</div>

@endsection