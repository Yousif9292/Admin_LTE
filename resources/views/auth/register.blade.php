<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group mb-3">
                    <input type="text" id="name" class="form-control" placeholder="Full name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>

                <!-- Email Address -->
                <div class="input-group mb-3">
                    <input type="email" id="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required autocomplete="username" />
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <x-text-input id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    required autocomplete="new-password" />
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>

                <!-- Confirm Password -->
                <div class="input-group mb-3">

                    <x-text-input id="password_confirmation" class="form-control"
                                    type="password"
                                    placeholder="Confir Password"
                                    name="password_confirmation" required autocomplete="new-password" />
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>

                <!-- Agreed Checkbox -->
                <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                         I agree to the <a href="#">terms</a>
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" name="register" class="btn btn-primary btn-block">  {{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
                </div>
            </form>
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                    </a>
                </div>

                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>

