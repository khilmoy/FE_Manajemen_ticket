@extends('layouts.app')

@section('title', 'Edit Konser')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="header-title mb-1">Edit Konser</h4>
                            <p class="text-muted mb-0">Perbarui detail konser <strong>{{ $konser['name'] }}</strong>.</p>
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

                    <form action="{{ route('konser.update', $konser['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            @if (!empty($konser['image_url']))
                                <div class="col-12 mb-3">
                                    <label class="form-label d-block">Gambar Saat Ini</label>
                                    <img src="{{ $konser['image_url'] }}" alt="{{ $konser['name'] }}"
                                        width="120" height="120" style="object-fit: cover; border-radius: 8px;">
                                </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Konser <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $konser['name']) }}">
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
                                            {{ old('kategori_id', $konser['kategori_id'] ?? '') == $kat['id'] ? 'selected' : '' }}>
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
                                    value="{{ old('date', \Carbon\Carbon::parse($konser['date'])->format('Y-m-d')) }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', $konser['location']) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Ganti Gambar</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="form-control @error('image') is-invalid @enderror">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $konser['description'] ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('konser.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i>
                                Update Konser
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection