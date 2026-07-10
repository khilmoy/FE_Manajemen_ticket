@extends('layouts.app')

@section('title', 'Ubah Kategori Tiket Konser')

@section('content')

   <div class="row justify-content-center">
      <div class="col-md-8 col-12">
         <div class="card">
            <div class="card-body">

               <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                     <h4 class="header-title mb-1">Ubah Kategori Tiket</h4>
                     <p class="text-muted mb-0">
                        Perbarui informasi kategori tiket untuk konser.
                     </p>
                  </div>
                  
                  <a href="{{ route('admin.kategori') }}" class="btn btn-light">
                     <i class="mdi mdi-arrow-left me-1"></i> Kembali
                  </a>
               </div>

               <hr class="mb-4">

               <div id="loading-state" class="text-center my-4 d-none">
                  <div class="spinner-border text-primary" role="status"></div>
                  <p class="text-muted mt-2">Memuat data kategori...</p>
               </div>

               <form id="updateCategoryForm">
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
                        <i class="mdi mdi-check me-1"></i> Simpan Perubahan
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
      
      const pathSegments = window.location.pathname.split('/');
      // Mencari ID (mengambil segmen sebelum kata 'edit' atau segmen terakhir jika tidak ada kata 'edit')
      const editIndex = pathSegments.indexOf('update');
      const categoryId = editIndex !== -1 ? pathSegments[editIndex - 1] : pathSegments[pathSegments.length - 1];

      function getCsrfToken() {
         const tokenTag = document.querySelector('meta[name="csrf-token"]');
         return tokenTag ? tokenTag.getAttribute('content') : '';
      }

      // 1. AMBIL DATA LAMA DAN MASUKKAN KE FORM (GET DETAIL)
      async function getCategoryDetail() {
         if (!categoryId || isNaN(categoryId)) {
            alert('ID Kategori tidak valid!');
            return;
         }

         const form = document.getElementById('updateCategoryForm');
         const loadingState = document.getElementById('loading-state');
         
         form.classList.add('d-none');
         loadingState.classList.remove('d-none');

         try {
            const response = await fetch(`${API_URL}/kategori-konser/${categoryId}`, {
               headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();

            if (!response.ok) {
               throw new Error(result.message || 'Gagal mengambil data kategori');
            }

            // Isikan data dari API ke input form (sesuaikan field object data dari API Anda)
            const item = result.data || result; 
            document.getElementById('name').value = item.name;
            document.getElementById('description').value = item.description ?? '';

            form.classList.remove('d-none');
            loadingState.classList.add('d-none');

         } catch (e) {
            console.error(e);
            alert(`Error mengambil data: ${e.message}`);
            window.location.href = "{{ route('admin.kategori') }}";
         }
      }

      // Jalankan fungsi fetch data awal saat DOM siap
      document.addEventListener("DOMContentLoaded", getCategoryDetail);


      // 2. PROSES UPDATE DATA VIA PUT METHOD
      document.getElementById('updateCategoryForm').addEventListener('submit', async function(e) {
         e.preventDefault(); 

         const btnSimpan = document.getElementById('btnSimpan');
         const name = document.getElementById('name').value;
         const description = document.getElementById('description').value;

         btnSimpan.disabled = true;
         btnSimpan.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...`;

         try {
            // URL diarahkan spesifik ke ID yang ingin diubah
            const response = await fetch(`${API_URL}/kategori-konser/${categoryId}`, {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': getCsrfToken() 
               },
               body: JSON.stringify({ name, description })
            });

            const result = await response.json();

            if (!response.ok) {
               throw new Error(result.message || 'Gagal memperbarui kategori');
            }

            alert('Kategori berhasil diperbarui!');
            window.location.href = "{{ route('admin.kategori') }}";

         } catch (e) {
            console.error(e);
            alert(`Error: ${e.message}`);
            
            btnSimpan.disabled = false;
            btnSimpan.innerHTML = `<i class="mdi mdi-check me-1"></i> Simpan Perubahan`;
         }
      });
   </script>
@endpush