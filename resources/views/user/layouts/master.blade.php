
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Darkrule @if(isset($title)) {{ $title }} @endif </title>

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
<body class="layout-top-nav">
<div class="wrapper">
  <!-- Navbar -->
  @include('user.layouts.header')
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="container">
        @yield('content')
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>{{__('Copyright')}} &copy; 2014-<?php date('Y') ?> <a href="https://darkrule.shop">Darkrule Shop</a>.</strong>
    {{__('All rights reserved.')}}
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
