@extends('layouts.app')

@section('content')

<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box row">
            <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url({{ URL::asset('img/login-image.png') }});">
            </div>
            <div class="col-lg-5 col-md-7 bg-white">
                <div class="p-3">
                    <div class="text-center">
                        <img src="../assets/images/big/icon.png" alt="wrapkit">
                    </div>
                    <h2 class="mt-3 text-center">{{ __("Sign In") }}</h2>
                    <p class="text-center">{{ __("Enter your email address and password to access admin panel") }}</p>
                    <form class="mt-4" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark {{ App()->currentLocale() == 'ar' ? 'pull-right' : 'pull-left' }}" for="email">{{ __("Email Address") }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('enter your email address') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="password">{{ __("Password") }}</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" required autocomplete="current-password" placeholder="{{ __('enter your password') }}">


                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center mt-3">
                                <button type="submit" class="btn btn-block btn-dark">{{ __("Sign In") }}</button>
                            </div>
                            <!-- <div class="col-lg-12 text-center mt-5">
                                {{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="text-danger">{{ __("Sign Up") }}</a>
                                </div> -->
                            @if (Route::has('password.request'))
                            <div class="col-lg-12 text-center mt-3">
                                {{ __("Forgot Your Password?") }} <a href="{{ route('password.request') }}" class="text-danger">{{ __("Get It") }}</a>
                            </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
</div>
@endsection
