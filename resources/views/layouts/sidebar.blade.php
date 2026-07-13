<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu" style="background:#3b82f6 !important; color:#fff !important;">

   <!-- Logo -->
   <a href=""
      class="logo logo-light d-flex align-items-center ms-3 text-decoration-none"
      style="background:#3b82f6 !important; color:#fff !important; height:70px;">

      <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo Rumah Tiket" height="45">

      <span style="color:#fff; font-size:24px; font-weight:bold; margin-left:10px; margin-top:15px;">
         Rumah Tiket
      </span>
   </a>

   <hr>

   <div class="h-100"
      id="leftside-menu-container"
      data-simplebar
      style="background:#3b82f6 !important;">

      <ul class="side-nav">

         <li class="side-nav-title side-nav-item"
            style="color:#dbeafe !important;">
            Navigation
         </li>

         <li class="side-nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="side-nav-link"
               style="color:#fff !important;">

               <i class="uil-home-alt" style="color:#fff !important;"></i>

               <span style="color:#fff !important;">
                  Dashboard
               </span>
            </a>
         </li>

         <hr>

         <li class="side-nav-title side-nav-item"
            style="color:#dbeafe !important;">
            Apps
         </li>

         <li class="side-nav-item">
            <a href="{{ route('kategori.index') }}"
               class="side-nav-link"
               style="color:#fff !important;">

               <i class="uil-calender" style="color:#fff !important;"></i>

               <span style="color:#fff !important;">
                  Kategori
               </span>
            </a>
         </li>
         
         <li class="side-nav-item">
            <a href="{{ route('konser.index') }}"
               class="side-nav-link"
               style="color:#fff !important;">

               <i class="uil uil-users-alt style="color:#fff !important;"></i>

               <span style="color:#fff !important;">
                  Konser
               </span>
            </a>
         </li>

      </ul>

   </div>

</div>
<!-- Left Sidebar End -->