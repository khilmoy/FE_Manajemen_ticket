<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>@yield('title', 'Dashboard') | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
   <meta content="Coderthemes" name="author">
   <!-- App favicon -->
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

   <!-- third party css -->
   <link href="{{ asset('assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css">
   <!-- third party css end -->

   <!-- App css -->
   <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
   <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">

   @stack('styles')
</head>

<body class="loading"
   data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

   <!-- Begin page -->
   <div class="wrapper" >

      <!-- ========== Left Sidebar Start ========== -->
      @include('layouts.sidebar')
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->
      <div class="content-page">
         <div class="content">

            <!-- Topbar Start -->
            @include('layouts.topbar')
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid mt-3">
               @yield('content')
            </div>
            <!-- container -->

         </div>
         <!-- content -->

         <!-- Footer Start -->
         <footer class="footer">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-6">
                     {{ date('Y') }} &copy; Hyper - Coderthemes.com
                  </div>
                  <div class="col-md-6">
                     <div class="text-md-end footer-links d-none d-md-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- end Footer -->

      </div>
      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

   </div>
   <!-- END wrapper -->

   <!-- Right Sidebar -->
   @include('layouts.right-sidebar')

   <!-- bundle -->
   <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
   <script src="{{ asset('assets/js/app.min.js') }}"></script>

   <!-- third party js -->
   <script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>
   <script src="{{ asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
   <script src="{{ asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
   <!-- third party js ends -->

   @stack('scripts')
</body>

</html>