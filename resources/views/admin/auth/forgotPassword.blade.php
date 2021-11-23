@php
    $setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>{{$setting->website_title}} - Forgot Password</title>
        
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
                                <h1>Recover Password</h1>
                                <p class="account-subtitle">Get the reset password email!</p>
                                
                                <!-- Form -->
                                <form action="{{ route('forget.password.post') }}" method="POST">
                                    @csrf()
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="text" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">Send Password Reset Email</button>
                                    </div>
                                </form>
                                <!-- /Form -->
                                
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