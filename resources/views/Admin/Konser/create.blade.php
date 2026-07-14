@extends('layouts.app')

@section('title', 'Tambah Konser')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="header-title mb-1">Tambah Konser</h4>
                            <p class="text-muted mb-0">Isi detail konser beserta tiket yang tersedia.</p>
                        </div>

                        <a href="{{ route('konser.index') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('konser.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h5 class="mb-3">Detail Konser</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Konser <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="Contoh: Dewa 19 Live in Concert">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori_id" id="kategori_id"
                                    class="form-select @error('kategori_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat['id'] }}"
                                            {{ old('kategori_id') == $kat['id'] ? 'selected' : '' }}>
                                            {{ $kat['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                    value="{{ old('date') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location') }}" placeholder="Contoh: Surabaya">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Gambar Konser</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="form-control @error('image') is-invalid @enderror">
                                <small class="text-muted">Format jpg/jpeg/png, maksimal 2MB.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Deskripsi singkat konser (opsional)">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Tiket Awal</h5>
                        <p class="text-muted small mb-3">
                            Tambahkan minimal satu jenis tiket untuk konser ini. Kamu bisa menambah jenis tiket lain nanti dari halaman detail konser.
                        </p>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="ticket_name" class="form-label">Nama Tiket <span class="text-danger">*</span></label>
                                <input type="text" name="ticket_name" id="ticket_name"
                                    class="form-control @error('ticket_name') is-invalid @enderror"
                                    value="{{ old('ticket_name') }}" placeholder="Contoh: VIP">
                                @error('ticket_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" id="price" min="0"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="0">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stock" id="stock" min="0"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    value="{{ old('stock') }}" placeholder="0">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('konser.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i>
                                Simpan Konser
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection