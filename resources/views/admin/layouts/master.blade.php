
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkullNet @if(isset($title)) {{ $title }} @endif </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
  <!-- Theme style -->
<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/sg-style.css') }}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.layouts.sidebar')
  <!-- End of Main Sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="content-fluid">
          @yield('content')
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-<?php date('Y') ?> <a href="https://darkrule.shop">Darkrule Shop</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('js/adminlte.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<!-- bootstrap-daterangepicker -->
<script src="{{asset('js/moment.js')}}"></script>


<script>
    $(function(){
        function countOrderItems(){
            $.ajax({
                url: '/cart/count/orderItems',
                method: 'GET',
                success: function(res){
                    $("#countOrderItems").siblings().remove();
                    $(`<span class="badge badge-warning navbar-badge">${res.countOrderItems ? res.countOrderItems : '0'}</span>`).insertAfter($("#countOrderItems"));
                }
            });
        }
        countOrderItems();
    });
</script>

@yield('extra_script')

</body>
</html>
