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

                  <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                     <i class="mdi mdi-plus me-1"></i>
                     Tambah Kategori
                  </a>
               </div>

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

                     <tbody id="category-table-body">
                        <tr>
                           <td colspan="4" class="text-center text-muted">Memuat data...</td>
                        </tr>
                     </tbody>
                  </table>
               </div>

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

      // 1. FUNGSI LOAD DATA KE TABEL
      async function loadCategories() {
         const tbody = document.getElementById('category-table-body');

         try {
            const response = await fetch(`${API_URL}/kategori-konser`, {
               headers: {
                  Accept: 'application/json'
               }
            });

            console.log("Status :", response.status);
            const text = await response.text();
            console.log("Response :", text);

            const data = JSON.parse(text);
            console.log("Data :", data);

            if (!Array.isArray(data)) {
               throw new Error("Response bukan array");
            }

            if (data.length === 0) {
               tbody.innerHTML = `
                  <tr>
                     <td colspan="4" class="text-center text-muted">
                        Belum ada data
                     </td>
                  </tr>
               `;
               return;
            }

            let html = "";

            data.forEach((item, index) => {
               // Membuat link edit dinamis menggunakan base URL aplikasi menuju ID item
               const editUrl = `{{ url('/admin/kategori') }}/${item.id}/update`;

               html += `
                  <tr>
         <td>${index + 1}</td>
         <td><strong>${item.name}</strong></td>
         <td>${item.description ?? "-"}</td>
         <td class="text-center">
            <div class="d-flex justify-content-center gap-2">
               
               <a href="${editUrl}" class="btn btn-sm d-inline-flex align-items-center px-3 py-1.5 fw-semibold border-0" 
                  style="background-color: rgba(241, 180, 76, 0.12); color: #f1b44c; border-radius: 8px; transition: all 0.2s ease-in-out;"
                  onmouseenter="this.style.backgroundColor='#f1b44c'; this.style.color='#fff'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(241, 180, 76, 0.25)'"
                  onmouseleave="this.style.backgroundColor='rgba(241, 180, 76, 0.12)'; this.style.color='#f1b44c'; this.style.transform='none'; this.style.boxShadow='none'">
                  <i class="mdi mdi-pencil me-1.5"></i> Edit
               </a>
               
               <button type="button" onclick="hapusKategori(${item.id})" class="btn btn-sm d-inline-flex align-items-center px-3 py-1.5 fw-semibold border-0"
                  style="background-color: rgba(243, 79, 79, 0.12); color: #f34f4f; border-radius: 8px; transition: all 0.2s ease-in-out;"
                  onmouseenter="this.style.backgroundColor='#f34f4f'; this.style.color='#fff'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(243, 79, 79, 0.25)'"
                  onmouseleave="this.style.backgroundColor='rgba(243, 79, 79, 0.12)'; this.style.color='#f34f4f'; this.style.transform='none'; this.style.boxShadow='none'">
                  <i class="mdi mdi-trash-can me-1.5"></i> Hapus
               </button>

            </div>
         </td>
      </tr>
   `;
            });

            tbody.innerHTML = html;

         } catch (e) {
            console.error(e);
            tbody.innerHTML = `
               <tr>
                  <td colspan="4" class="text-danger text-center">
                     ${e.message}
                  </td>
               </tr>
            `;
         }
      }

      // 2. FUNGSI HAPUS DATA VIA API
      // FUNGSI HAPUS DATA VIA API
      async function hapusKategori(id) {
         if (!confirm('Apakah Anda yakin ingin menghapus kategori tiket ini?')) {
            return;
         }

         try {
            const response = await fetch(`${API_URL}/kategori-konser/${id}`, {
               method: 'DELETE',
               headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': getCsrfToken()
               }
            });

            // JIKA STATUSNYA BERHASIL (200 OK atau 204 No Content)
            if (response.ok) {
               alert('Kategori berhasil dihapus!');
               loadCategories(); // Muat ulang tabel
               return; // Berhenti di sini, tidak perlu baca JSON bawahnya
            }

            // Jika gagal (status selain 2xx), baru kita baca error JSON-nya
            const result = await response.json();
            throw new Error(result.message || 'Gagal menghapus data');

         } catch (e) {
            console.error(e);
            alert(`Error: ${e.message}`);
         }
      }

      document.addEventListener("DOMContentLoaded", loadCategories);
   </script>
@endpush
