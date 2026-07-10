@extends('layouts.app')

@section('title', 'Tambah Kategori Tiket Konser')

@section('content')

   <div class="row justify-content-center">
      <div class="col-md-8 col-12">
         <div class="card">
            <div class="card-body">

               <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                     <h4 class="header-title mb-1">Tambah Kategori Tiket</h4>
                     <p class="text-muted mb-0">
                        Buat kategori tiket baru untuk konser.
                     </p>
                  </div>
                  
                  <a href="{{ url('/kategori-konser') }}" class="btn btn-light">
                     <i class="mdi mdi-arrow-left me-1"></i> Kembali
                  </a>
               </div>

               <hr class="mb-4">

               <form id="createCategoryForm">
                  <div class="mb-3">
                     <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: VIP, CAT 1, Festival" required>
                  </div>

                  <div class="mb-4">
                     <label for="description" class="form-label">Deskripsi</label>
                     <textarea class="form-control" id="description" name="description" rows="4" placeholder="Masukkan detail atau keuntungan kategori tiket ini..."></textarea>
                  </div>

                  <div class="d-flex justify-content-end gap-2">
                     <button type="button" class="btn btn-light" onclick="window.history.back()">Batal</button>
                     <button type="submit" class="btn btn-primary" id="btnSimpan">
                        <i class="mdi mdi-check me-1"></i> Simpan Kategori
                     </button>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>

@endsection

@push('scripts')
   <script>
      const API_URL = "http://127.0.0.1:8000/api";

      function getCsrfToken() {
         const tokenTag = document.querySelector('meta[name="csrf-token"]');
         return tokenTag ? tokenTag.getAttribute('content') : '';
      }

      // Handle proses submit form via Fetch API
      document.getElementById('createCategoryForm').addEventListener('submit', async function(e) {
         e.preventDefault(); // Mencegah page reload bawaan form

         const btnSimpan = document.getElementById('btnSimpan');
         const name = document.getElementById('name').value;
         const description = document.getElementById('description').value;

         // Efek Loading pada tombol saat proses simpan
         btnSimpan.disabled = true;
         btnSimpan.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...`;

         try {
            const response = await fetch(`${API_URL}/kategori-konser`, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': getCsrfToken() 
               },
               body: JSON.stringify({ name, description })
            });

            const result = await response.json();

            if (!response.ok) {
               throw new Error(result.message || 'Gagal menambahkan kategori');
            }

            alert('Kategori berhasil ditambahkan!');
            
            // Redirect kembali ke halaman utama kategori (sesuaikan URL-nya jika berbeda)
            window.location.href = "{{ Route('admin.kategori') }}";

         } catch (e) {
            console.error(e);
            alert(`Error: ${e.message}`);
            
            
            btnSimpan.disabled = false;
            btnSimpan.innerHTML = `<i class="mdi mdi-check me-1"></i> Simpan Kategori`;
         }
      });
   </script>
@endpush