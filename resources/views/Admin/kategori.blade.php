@extends('layouts.app')

@section('title', 'Kategori Tiket Konser')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
               <div>
                  <h4 class="header-title mb-1">Kategori Tiket Konser</h4>
                  <p class="text-muted mb-0">
                     Kelola kategori tiket yang tersedia untuk setiap konser.
                  </p>
               </div>

               <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                  <i class="mdi mdi-plus me-1"></i>
                  Tambah Kategori
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
                        <th width="70">No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th width="180" class="text-center">Aksi</th>
                     </tr>
                  </thead>

                  <tbody>
                     @forelse ($kategori as $index => $item)
                        <tr>
                           <td>{{ $index + 1 }}</td>
                           <td><strong>{{ $item['name'] }}</strong></td>
                           <td>{{ $item['description'] ?? '-' }}</td>
                           <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">

                                 <a href="{{ route('kategori.edit', $item['id']) }}"
                                    class="btn btn-sm d-inline-flex align-items-center px-3 py-1.5 fw-semibold border-0"
                                    style="background-color: rgba(241, 180, 76, 0.12); color: #f1b44c; border-radius: 8px; transition: all 0.2s ease-in-out;"
                                    onmouseenter="this.style.backgroundColor='#f1b44c'; this.style.color='#fff';"
                                    onmouseleave="this.style.backgroundColor='rgba(241, 180, 76, 0.12)'; this.style.color='#f1b44c';">
                                    <i class="mdi mdi-pencil me-1"></i> Edit
                                 </a>

                                 <form action="{{ route('kategori.destroy', $item['id']) }}"
                                       method="POST"
                                       onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori tiket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                       class="btn btn-sm d-inline-flex align-items-center px-3 py-1.5 fw-semibold border-0"
                                       style="background-color: rgba(243, 79, 79, 0.12); color: #f34f4f; border-radius: 8px; transition: all 0.2s ease-in-out;"
                                       onmouseenter="this.style.backgroundColor='#f34f4f'; this.style.color='#fff';"
                                       onmouseleave="this.style.backgroundColor='rgba(243, 79, 79, 0.12)'; this.style.color='#f34f4f';">
                                       <i class="mdi mdi-trash-can me-1"></i> Hapus
                                    </button>
                                 </form>

                              </div>
                           </td>
                        </tr>
                     @empty
                        <tr>
                           <td colspan="4" class="text-center text-muted">Belum ada data</td>
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