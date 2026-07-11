{{-- resources/views/admin/kategori/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">Edit Kategori Tiket</h4>

            @if ($errors->any())
               <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('kategori.update', $kategori['id']) }}">
               @csrf
               @method('PUT')

               <div class="mb-3">
                  <label class="form-label">Nama Kategori</label>
                  <input type="text" name="name" class="form-control"
                         value="{{ old('name', $kategori['name']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="description" class="form-control" rows="3">{{ old('description', $kategori['description']) }}</textarea>
               </div>

               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ route('kategori.index') }}" class="btn btn-light">Batal</a>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection