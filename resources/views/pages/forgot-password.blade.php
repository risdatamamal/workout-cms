<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forgot Password | {{ config('app.name', 'MY GYM') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/theme-image.css') }}">
    <script src="{{ asset('src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100"
                style="background: linear-gradient(180deg, #176E5E 84.89%, rgba(236, 233, 233, 0) 100%);">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    <div class="text-center">
                        <a href=""><img width="150" src="{{ asset('img/logo-mygym.png') }}"
                                alt="Logo"></a>
                    </div>
                    <div class="authentication-form mx-auto">
                        <h3 class="text-center fw-700">{{ __('Forgot Password') }}</h3>
                        <p class="text-center">{{ __('We will send you a link to reset password.') }}</p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Your email address" name="email" value="{{ old('email') }}"
                                    required>
                                <i class="ik ik-mail"></i>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="sign-btn text-center">
                                <button class="btn btn-custom">{{ __('Submit') }}</button>
                            </div>
                        </form>
                        <div class="register">
                            <p>{{ __('Have a account') }}? <a href="{{ route('login') }}" class="text-success">{{ __('Login') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('plugins/popper.js') }}/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/screenfull/dist/screenfull.js') }}"></script>
</body>

</html>
