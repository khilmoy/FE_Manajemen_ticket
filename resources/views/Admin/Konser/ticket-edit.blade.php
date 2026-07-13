@extends('layouts.app')

@section('title', 'Edit Tiket')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-1">Edit Tiket</h4>
            <p class="text-muted mb-4">untuk konser: <strong>{{ $konser['name'] }}</strong></p>

            @if ($errors->any())
               <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('konser.ticket.update', [$konser['id'], $ticket['id']]) }}">
               @csrf
               @method('PUT')

               <div class="mb-3">
                  <label class="form-label">Nama Tiket</label>
                  <input type="text" name="ticket_name" class="form-control"
                         value="{{ old('ticket_name', $ticket['ticket_name']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Harga</label>
                  <input type="number" step="0.01" min="0" name="price" class="form-control"
                         value="{{ old('price', $ticket['price']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Stok</label>
                  <input type="number" min="0" name="stock" class="form-control"
                         value="{{ old('stock', $ticket['stock']) }}" required>
               </div>

               <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" required>
                     <option value="available" {{ old('status', $ticket['status']) === 'available' ? 'selected' : '' }}>Tersedia</option>
                     <option value="sold_out" {{ old('status', $ticket['status']) === 'sold_out' ? 'selected' : '' }}>Habis</option>
                  </select>
               </div>

               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ route('konser.show', $konser['id']) }}" class="btn btn-light">Batal</a>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection