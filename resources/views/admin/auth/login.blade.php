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
            <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">
        @endif

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="/assets/admin/css/font-awesome.min.css">
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="/assets/admin/css/style.css">
        
        <!--[if lt IE 9]>
            <script src="/assets/js/html5shiv.min.js"></script>
            <script src="/assets/js/respond.min.js"></script>
        <![endif]-->
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
                                <img class="img-fluid" src="/assets/admin/img/logo-white.png" alt="Logo">
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
                                
                                <div class="text-center forgotpass"><a href="{{ route('forget.password.get') }}">Forgot Password?</a></div>
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
        </div>


        @if ($message = Session::get('success'))
            <div class="alert alert-success bg-success alert-dismissible text-white border-0 fade show" role="alert">
                <span>{{ $message }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($message = Session::get('warning'))
            <div class="alert alert-warning bg-warning alert-dismissible text-white border-0 fade show" role="alert">
                <span>{{ $message }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($message = Session::get('danger'))
            <div class="alert alert-danger bg-danger alert-dismissible text-white border-0 fade show" role="alert">
                <span>{{ $message }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($message = Session::get('info'))
            <div class="alert alert-info bg-info alert-dismissible text-white border-0 fade show" role="alert">
                <span>{{ $message }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif



        <!-- /Main Wrapper -->
        
        <!-- jQuery -->
        <script src="/assets/js/jquery-3.2.1.min.js"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="/assets/js/popper.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        
        <!-- Custom JS -->
        <script src="/assets/js/script.js"></script>
        
    </body>

</html>