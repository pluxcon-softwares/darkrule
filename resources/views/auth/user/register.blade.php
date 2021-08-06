<html lang="en" style="height: auto;"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Darkrule | Log in</title>

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
          <img src="{{ asset('images/darkrule_site_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Darkrule</span>
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
                    <div class="login-logo" style="font-size:30px;">
                      <img src="{{asset('images/darkrule_site_logo.png')}}" alt="site-logo" width="50px;">
                      Darkrule
                    </div>
                    <!-- /.login-logo -->
                    <div class="card">
                      <div class="card-body login-card-body">

                        <h4 class="login-box-msg">Create new account</h4>

                        <form action="{{ route('store') }}" method="POST" id="registerForm">
                          @csrf

                        <div class="form-group">
                          <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="{{ __('Username') }}">
                          <div class="invalid-feedback" style="color:#ffffff; font-size:12px; margin-top:-10px;">
                              {{$errors->first('username')}}
                          </div>
                        </div>

                        <div class="form-group">
                          <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                          <div class="invalid-feedback" style="color:#ffffff; font-size:12px; margin-top:-10px;">
                              {{$errors->first('email')}}
                          </div>
                        </div>

                        <div class="form-group">
                          <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                          <div class="invalid-feedback" style="color:#ffffff; font-size:12px; margin-top:-10px;">
                            {{$errors->first('password')}}
                          </div>
                        </div>

                        <div>
                          <input type="password" name="password_confirmation" class="form-control" placeholder="{{__('Confirm Password')}}">
                        </div>

                        <div class="form-group">
                          <p style="font-size: 12px; text-align:center;">{{__('Please type the Number EXACTLY like in the image')}}</p>
                        </div>

                        <div class="form-group">
                          <div class="row">

                              <div class="col-md-5 col-xs-5">
                                  <?php
                                      $captchaImage = null;
                                      for($i = 0; $i < 5; $i++){  $captchaImage .= mt_rand(0, 9);}
                                  ?>
                                  <input type="text" class="form-control" value="{{ $captchaImage }}" disabled />
                                  <input type="hidden" class="form-control" value="{{ $captchaImage }}" name="captcha_image" />
                              </div>

                              <div class="col-md-7">
                                  <input type="text" class="form-control" placeholder="{{__('Enter CAPTCHA')}}" name="captcha_text" />
                              </div>

                             </div>
                        </div>

                        <div>
                          @if(session()->has('captcha_error'))
                          <p style="text-align: center; color: red; text-align: center;">{{ __(session('captcha_error')) }}</p>
                          @endif

                        @if($errors->has('captcha_text'))
                              <p style="font-size: 12px; color: red; text-align: center;">{{ __($errors->first('captcha_text')) }}</p>
                        @endif

                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-block btn-success">{{ __('Register') }}</button>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                  <h6>{{__('Already have account?')}}</h6>
                                </div>
                                <div class="col-md-5">
                                  <a href="{{ route('login') }}" class="btn btn-block btn-warning">{{ __('Sign In') }}</a>
                                </div>
                            </div>
                        </div>

                      </form>
                      </div>
                      <!-- /.login-card-body -->
                    </div>
                  </div>
                  <!-- /.login-box -->
            </div>
            <div class="row mb-5"></div>
            <div class="row"></div>
            <!-- /.login-box -->
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">

      <!-- Default to the left -->
      <strong>Copyright © 2014-<?php echo date('Y') ?> <a href="#">Darkrule Shop</a>.</strong> All rights reserved.
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
