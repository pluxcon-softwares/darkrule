<html lang="en" style="height: auto;"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

  </head>
  <body class="layout-top-nav" style="height: auto;">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
          <img src="{{ asset('images/blackcrow.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="">
          <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ url()->current()}}?lang=en" role="button" style="font-size: 12px;">
                  <img src="{{ asset('images/united-states.png') }}" style="width: 18px;" /> EN
                </a>
              </li>
            <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ url()->current()}}?lang=ru" role="button" style="font-size: 12px;">
              <img src="{{ asset('images/russia.png') }}" style="width: 18px;" /> RU
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="">

      <!-- Main content -->
      <div class="content">
        <div class="container">
            <div class="row"></div>
            <div class="row justify-content-center" style="margin-top:100px;">
                <div class="login-box">
                    <div class="login-logo">
                      <img src="{{asset('images/blackcrow.png')}}" alt="site-logo" width="20%">
                      {{ config('app.name') }}
                    </div>
                    <!-- /.login-logo -->
                    <div class="card">
                      <div class="card-body login-card-body">

                        <h4 class="login-box-msg">{{ __('Member Login') }}</h4>

                        <form action="{{route('login.submit')}}" method="POST">
                          @csrf

                        @if(session()->has('error'))
                          <p style="font-size: 14px; color: red; text-align:center;">{{ session('error') }}</p>
                        @endif

                      @if(session()->has('success'))
                      <p style="font-size: 14px; color: red; text-align:center;">{{ session('success') }}</p>
                      @endif

                        <div class="input-group mb-3">
                          <input type="text" name="email" class="form-control" placeholder="{{ __('Email') }}" />
                          <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                          @if($errors->has('email'))
                          <p style="font-size: 12px; color: red;">{{ $errors->first('email') }}</p>
                          @endif
                        </div>

                        <div class="input-group mb-3">
                          <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" />
                          <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                          </div>
                          @if($errors->has('password'))
                          <p style="font-size: 12px; color: red;">{{ $errors->first('password') }}</p>
                          @endif
                        </div>

                        <div class="mt-2">
                          <p style="font-size: 12px; text-align:center;">{{ __('Please type the Number EXACTLY like in number box') }}</p>
                        </div>

                        <div class="row">

                          <div class="col-md-5 col-sm-5 col-xs-5">
                              <?php
                                  $captchaImage = null;
                                  for($i = 0; $i < 5; $i++){  $captchaImage .= mt_rand(0, 9);}
                              ?>
                              <input type="text" class="form-control" value="{{ $captchaImage }}" disabled />
                              <input type="hidden" class="form-control" value="{{ $captchaImage }}" name="captcha_image" />
                          </div>

                          <div class="col-md-7 col-sm-7">
                              <input type="text" class="form-control" placeholder="{{__('Enter CAPTCHA')}}" name="captcha_text" />
                          </div>

                          @if(session()->has('captcha_error'))
                          <div>
                              <p style="text-align: center; text-align: center; color: red">{{ __(session('captcha_error')) }}</p>
                          </div>
                          @endif

                          @if($errors->has('captcha_text'))
                          <p style="font-size: 12px; text-align: center; color: red;">{{ __($errors->first('captcha_text')) }}</p>
                          @endif

                          <div class="clearfix"></div>

                       </div>

                        <div class="row mb-3 mt-3">
                          <div class="col-md-7 col-sm-7 col-xs-12">
                              <a href="{{route('create')}}" class="btn btn-info"> {{__('Create Account')}} </a>
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-12">
                              <button type="submit" class="btn btn-danger">{{__('Log in')}}</button>
                          </div>
                        </div>

                      </form>


                        {{-- <p class="mb-1">
                          <a href="forgot-password.html">I forgot my password</a>
                        </p> --}}
                      </div>
                      <!-- /.login-card-body -->
                    </div>
                  </div>
            </div>
            <!-- /.login-box -->
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">

      <!-- Default to the left -->
      <strong>{{__('Copyright')}} © 2014-<?php echo date('Y') ?> <a href="#">{{ config('app.name') }}</a>.</strong> {{__('All rights reserved.')}}
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte.min.js') }}"></script>

  </body>
  </html>
