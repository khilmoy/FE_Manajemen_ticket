@extends('layouts.app')

@section('title', 'Edit Konser')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">Edit Konser</h4>

            @if ($errors->any())
               <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('konser.update', $konser['id']) }}">
               @csrf
               @method('PUT')

               <div class="mb-3">
                  <label class="form-label">Kategori</label>
                  <select name="kategori_id" class="form-select" required>
                     <option value="">-- Pilih Kategori --</option>
                     @foreach ($kategori as $item)
                        <option value="{{ $item['id'] }}"
                           {{ old('kategori_id', $konser['kategori_id']) == $item['id'] ? 'selected' : '' }}>
                           {{ $item['name'] }}
                        </option>
                     @endforeach
                  </select>
               </div>

               <div class="mb-3">
                  <label class="form-label">Nama Konser</label>
                  <input type="text" name="name" class="form-control"
                         value="{{ old('name', $konser['name']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Tanggal</label>
                  <input type="date" name="date" class="form-control"
                         value="{{ old('date', $konser['date']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Lokasi</label>
                  <input type="text" name="location" class="form-control"
                         value="{{ old('location', $konser['location']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="description" class="form-control" rows="3">{{ old('description', $konser['description']) }}</textarea>
               </div>

               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ route('konser.index') }}" class="btn btn-light">Batal</a>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection