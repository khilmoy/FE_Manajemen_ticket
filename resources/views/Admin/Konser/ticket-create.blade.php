@extends('layouts.app')

@section('title', 'Tambah Tiket')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-1">Tambah Tiket</h4>
            <p class="text-muted mb-4">untuk konser: <strong>{{ $konser['name'] }}</strong></p>

            @if ($errors->any())
               <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('konser.ticket.store', $konser['id']) }}">
               @csrf

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

               <button type="submit" class="btn btn-primary">Simpan</button>
               <a href="{{ route('konser.show', $konser['id']) }}" class="btn btn-light">Batal</a>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection