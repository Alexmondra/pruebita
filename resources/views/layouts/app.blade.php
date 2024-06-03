<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sistem de syntax_systems para control de solicitudes</title>
    <link rel="icon" type="image/png" href="{{asset('favicon.ico')}}">
    <!-- Font Inter var -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}"> 
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">-->
     <link rel="stylesheet" href="{{asset('css/adminlte.css')}}"> 
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">-->
    <!--<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">-->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('js/jquery-ui/jquery-ui.min.css')}}">
    <style>
      .sidebar-dark-blue{
        background: #455279 !important;
      }
    </style>
    @stack('estilos')
    <style>
      .ui-autocomplete { z-index:2147483647; }
    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
      </div>
      <!-- /.content-header -->
      {{ $slot }}
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>SisVisitas</h5>
        <p>Desarrollado grupo de DAPD</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      <div>Copyright &copy; derechos libres @Grupo DAPD.</div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/adminlte.min.js')}}"></script>
  <!--<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>-->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('js/sweetalert2@11.js')}}"></script>
  <!-- scripts de cada plantilla -->
  @stack('scripts')
  </body>
</html>
