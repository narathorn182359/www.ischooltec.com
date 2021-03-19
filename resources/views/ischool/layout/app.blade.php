<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ISCH | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css?v=').time() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/font-awesome/css/font-awesome.min.css?v=').time() }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/Ionicons/css/ionicons.min.css?v=').time() }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/AdminLTE.min.css?v=').time() }}">
 <!-- DataTables -->
 <link rel="stylesheet" href="{{asset('adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css?v=').time() }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminLTE/bower_components/select2/dist/css/select2.min.css?v=').time() }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <!-- Theme style -->
  <link href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css"
  media = "all"
  rel = "stylesheet"
  type = "text/css" />
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/AdminLTE.min.css?v=').time() }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/skins/_all-skins.min.css?v=').time() }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree&display=swap" rel="stylesheet">
<style>
  body,h1,h2,h3,h4,h5,h6,b,span{
    font-family: 'Bai Jamjuree', sans-serif;
  }
  #container {
  display: flex;
  justify-content:center;
}
table.table.table-striped.table-bordered td,

table.table.table-striped.table-bordered td.text {

/*max-width: 177px;*/

}

table.table.table-striped.table-bordered td,

table.table.table-striped.table-bordered td.text,

table.table.table-striped.table-bordered th,

table.table.table-striped.table-bordered th.text,

table.table.table-striped.table-bordered span {

white-space: nowrap;

overflow: hidden;

text-overflow: ellipsis;

max-width: 100%;

}

td {

max-width: 500px !important;

overflow: hidden;

text-overflow: ellipsis;

white-space: nowrap;

}
</style>
<style>
  td.details-control {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}
</style>
 </head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <!-- Main Header -->
  <header class="main-header">
  
    <!-- Logo -->
  <a href="{{url('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>CE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IschoolTec</b>TCE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminLTE/dist/img/user1.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>  {{ Auth::user()->username }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header">HEADER</li>
       @foreach ($listmenu as $listmenus )
      <li><a href="{{$listmenus->url}}"><i class="fa fa-link"></i><span> {{$listmenus->title}}</span></a></li>
       @endforeach
     <li>     <a  href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-in"></i>  <span>  {{ __('ออกจาระบบ') }} </span>
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        @isset($alf_name_school)
        @if($alf_name_school != '')
        {{$alf_name_school->name_school_a}}
        @endif
        @endisset
     
      
        <small>Version 1.0</small>
      </h1>
    
    </section>
    <!-- Content Header (Page header) -->
    @yield('contentheader')


    <!-- Main content -->
    <section class="content container-fluid">

        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ now()->year }} <a href="#">ischooltec</a>.</strong> All rights reserved.
  </footer>



</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('adminLTE/bower_components/jquery/dist/jquery.min.js?v=').time() }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js?v=').time() }}"></script>
<script src="{{asset('adminLTE/bower_components/select2/dist/js/select2.full.min.js?v=').time() }}"></script>

<!-- AdminLTE App -->
<script src="{{asset('adminLTE/dist/js/adminlte.min.js?v=').time() }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset('adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js?v=').time() }}"></script>
<script src="{{asset('adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js?v=').time() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
@yield('scriptUser')
@yield('scriptSchool')
@yield('scriptSchoolShow')
@yield('scripttable')
@yield('script')





<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
  </script>
</body>
</html>
