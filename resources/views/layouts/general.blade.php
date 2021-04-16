<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">
  @yield('title')

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('plantilla/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('plantilla/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

 




  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('plantilla/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  
   
  <link rel="stylesheet" href="{{ asset('css/toastr.css')}}"></link>  
  <link rel="stylesheet" href="{{ asset('js/general.js')}}"></link>                           


  @yield('links')


	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link">   @if(!empty($EmpresaNombre))
      <h3 class="font-weight-bold">{{$EmpresaNombre}}</h3>
      @else
      <span class="brand-text font-weight-light"></span>
      @endif</a>
     
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" title="Opciones" data-toggle="dropdown" >
        <i class="fas fa-user"></i>
          
        </a>
        <div class="dropdown-menu  dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('root') }}"
                                   >
                                   Cambiar Empresa
                                 </a>
          
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          
      </li>
      

             
      <li class="nav-item">
        <a class="nav-link"data-slide="true" href="#">
          <!-- <i class="fas fa-th-large"></i>  data-widget="control-sidebar"  -->
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a href="{{route('root')}}" class="brand-link">
   <span class="logo-mini"><b>E</b>RP</span>
           @if(!empty($EmpresaSigla))
      <span class="brand-text font-weight-light">{{$EmpresaSigla}}</span>
      @else
      <span class="brand-text font-weight-light">Sistema-ERP</span>
      @endif
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('plantilla/dist/img/avatar04.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="{{route('root')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empresas</p>
                </a>
              </li> -->
              @if(!empty($idempresa))
              <li class="nav-item">
                <a href="{{route('listar-gestion',$idempresa)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestiones</p>
                </a>
              </li>
              @endif
              @if(!empty($idempresa))
              <li class="nav-item">
                <a href="{{route('verCuentas',$idempresa)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Plan de Cuentas</p>
                </a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="{{route('verComprobantes',$idempresa)}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comprobantes</p>
                </a>
              </li>
              <li class="nav-item">
          <a class="nav-link" href="{{route('vercategorias',$idempresa)}}">
          <i class="fas fa-store"></i>
            <p>Categorias</p></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('listar-articulos',$idempresa)}}">
          <i class="fas fa-store"></i>
            <p>Articulos</p></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('listar-notas-compra',$idempresa)}}">
          <i class="fas fa-sticky-note"></i>
            <p>Notas de Compra</p></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('listar-notas-ventas',$idempresa)}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <p>nota de venta</p></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{route('verReportes',$idempresa)}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <p>Reportes</p></a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-cogs"></i>
              <p>
                Configuraciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a  href="{{route ('configuracion-moneda',$idempresa)}}" class="nav-link">
                <i class="fas fa-money-bill"></i>
                  <p>Tipo de Cambio</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('verintegracion',$idempresa)}}">
                <i class="far fa-circle nav-icon"></i>
                  
                <span>configuracion cuentas</span></a>
              </li>
              <!-- <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li> -->
            </ul>
          </li>
              @endif

              <!-- @if(!empty($idgestion))
              <li class="nav-item">
                <a href="{{route('listar-periodos',$idgestion)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Periodos</p>
                </a>
              </li> -->

            
          
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Configuracion</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                 <ul class="treeview-menu">
              <li><a class="app-menu__item active" href="{{route ('configuracion-moneda',$idempresa)}}"><i class="icon fa fa-money"></i>&nbsp;&nbsp;&nbsp;Monedas</a></li>
                 </ul>
            </li>
              <!-- @endif -->
            </ul>
          </li>
          
            
              
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content">
  @yield('content')
  </section>
  </div>
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

   
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a></a>.</strong>
    Derechos Reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>







<!-- jQuery -->
<script src="{{ asset('plantilla/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plantilla/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plantilla/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('plantilla/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('plantilla/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('plantilla/plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plantilla/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plantilla/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('plantilla/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plantilla/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('plantilla/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plantilla/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('plantilla/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('plantilla/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('plantilla/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('plantilla/dist/js/demo.js')}}"></script>




<script src="{{ asset('js/toastr.js')}}"></script>
<script src="{{ asset('js/general.js')}}"></script>

@yield('scripts')
</body>
</html>