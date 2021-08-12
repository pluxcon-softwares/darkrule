
<!DOCTYPE html>
<html lang="en">
<head>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset('images/blackcrow.png')}}" alt="site-logo" width="15%">
    <a href="#"><b>{{ config('app.name') }}</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <h4 class="login-box-msg">Admin Login</h4>

      <form action="{{route('admin.login.submit')}}" method="POST">
        @csrf

      @if(session()->has('error'))
        <p style="font-size: 14px; color: red; text-align:center;">{{ session('error') }}</p>
      @endif

    @if(session()->has('success'))
    <p style="font-size: 14px; color: red; text-align:center;">{{ session('success') }}</p>
    @endif

      <div class="input-group mb-3">
        <input type="text" name="email" class="form-control" placeholder="Email" />
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

      </div>
      @if($errors->has('email'))
        <p style="font-size: 12px; color: red;">{{ $errors->first('email') }}</p>
        @endif

      <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" />
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
        </div>
      </div>
      @if($errors->has('password'))
      <p style="font-size: 12px; color: red;">{{ $errors->first('password') }}</p>
      @endif

      <div class="mt-2">
        <p style="font-size: 12px; text-align:center;">Please type the Number EXACTLY like in number box</p>
      </div>

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
            <input type="text" class="form-control" placeholder="Enter CAPTCHA" name="captcha_text" />
        </div>

        @if(session()->has('captcha_error'))
        <div>
            <p style="text-align: center; text-align: center; color: red">{{ session('captcha_error') }}</p>
        </div>
        @endif

        @if($errors->has('captcha_text'))
        <p style="font-size: 12px; text-align: center; color: red;">{{ $errors->first('captcha_text') }}</p>
        @endif

        <div class="clearfix"></div>

     </div>

      <div class="row mb-3 mt-3">
        <div class="col-md-5">
            <button type="submit" class="btn btn-danger">Log in</button>
        </div>
      </div>

    </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte.min.js') }}"></script>
</body>
</html>
