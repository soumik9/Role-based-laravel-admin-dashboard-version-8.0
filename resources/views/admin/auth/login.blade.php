@php
    $setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>{{$setting->website_title}} - Login</title>
        
        <!-- Favicon -->
        @if($setting->website_favicon != null || !empty($setting->website_favicon))
            <link rel="shortcut icon" type="image/x-icon" href="{{$setting->website_favicon}}">
        @else
            <link rel="shortcut icon" type="image/x-icon" href="/assets/admin/img/favicon-def.png">
        @endif

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="/assets/admin/css/font-awesome.min.css">
        <!-- toastr CSS -->
        <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
        <!-- Main CSS -->
        <link rel="stylesheet" href="/assets/admin/css/style.css">    
    </head>
    <body>
    
        <!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
                <div class="container">
                    <div class="loginbox">

                        <div class="login-left">
                            @if($setting->website_logo_light != null || !empty($setting->website_logo_light))
                                <img class="img-fluid" src="{{$setting->website_logo_light}}" alt="{{$setting->website_title}}">
                            @else
                                <img class="img-fluid" src="/assets/admin/img/logo-def.png" alt="Logo">
                            @endif
                        </div>

                        <div class="login-right">
                            <div class="login-right-wrap">
                                <h1>Login</h1>
                                <p class="account-subtitle">Access to our dashboard</p>
                                
                                <!-- Form -->
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf()
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="text" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input class="remember" id="remember" type="checkbox" name="remember">
                                        <label class="text-dark" for="remember">{{__('auth.form.remember')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                </form>
                                <!-- /Form -->
                                
                                <div class="text-center forgotpass">
                                    <a href="{{ route('forget.password.get') }}">Forgot Password?</a>
                                </div>
                                {{-- <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">or</span>
                                </div>
                                  
                                <!-- Social Login -->
                                <div class="social-login">
                                    <span>Login with</span>
                                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a>
                                </div>
                                <!-- /Social Login --> --}}
                                
                                {{-- <div class="text-center dont-have">Don’t have an account? <a href="register.html">Register</a></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /Main Wrapper -->
        
        <!-- jQuery -->
        <script src="/assets/admin/js/jquery-3.2.1.min.js"></script>
        <script src="/assets/admin/js/popper.min.js"></script>
        <script src="/assets/admin/js/bootstrap.min.js"></script>
        <!-- Custom JS -->
        <script src="/assets/admin/js/script.js"></script> 
        <!-- toastr JS -->
        <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
        {!! Toastr::message() !!}
    </body>
</html>