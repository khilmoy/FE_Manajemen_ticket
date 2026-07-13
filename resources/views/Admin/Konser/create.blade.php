@extends('layouts.app')

@section('title', 'Tambah Konser')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">Tambah Konser</h4>

            @if ($errors->any())
               <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('konser.store') }}">
               @csrf

               <h5 class="mb-3">Data Konser</h5>

               <div class="mb-3">
                  <label class="form-label">Kategori</label>
                  <select name="kategori_id" class="form-select" required>
                     <option value="">-- Pilih Kategori --</option>
                     @foreach ($kategori as $item)
                        <option value="{{ $item['id'] }}" {{ old('kategori_id') == $item['id'] ? 'selected' : '' }}>
                           {{ $item['name'] }}
                        </option>
                     @endforeach
                  </select>
               </div>

               <div class="mb-3">
                  <label class="form-label">Nama Konser</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Tanggal</label>
                  <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Lokasi</label>
                  <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
               </div>

               <hr class="my-4">

               <h5 class="mb-3">Tiket Awal untuk Konser Ini</h5>
               <p class="text-muted small mb-3">
                  Kamu bisa tambah tiket lain lagi nanti dari halaman detail konser.
               </p>

               <div class="mb-3">
                  <label class="form-label">Nama Tiket</label>
                  <input type="text" name="ticket_name" class="form-control" value="{{ old('ticket_name') }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Harga</label>
                  <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Stok</label>
                  <input type="number" min="0" name="stock" class="form-control" value="{{ old('stock') }}" required>
               </div>

               <button type="submit" class="btn btn-primary">Simpan Konser & Tiket</button>
               <a href="{{ route('konser.index') }}" class="btn btn-light">Batal</a>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection