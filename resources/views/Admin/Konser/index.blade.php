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
                                       onsubmit="return confirm('Yakin ingin menghapus konser ini?');" class="d-inline">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm fw-semibold border-0 text-center"
                                          style="min-width: 70px; background-color: rgba(243, 79, 79, 0.12); color: #f34f4f; border-radius: 8px;">
                                          <i class="mdi mdi-trash-can me-1"></i> Hapus
                                       </button>
                                    </form>

                                 </div>
                              </td>
                           </tr>
                        @empty
                           <tr>
                              <td colspan="6" class="text-center text-muted">Belum ada data</td>
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
