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
        <link rel="shortcut icon" type="image/x-icon" href="/assets/admin/img/favicon-def.png">
    @endif

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css">
    <!-- toastr CSS -->
    <link rel="stylesheet" href="/assets/admin/css/toastr.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/assets/admin/css/font-awesome.min.css">
    
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

                            </form><!-- /Form -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /Main Wrapper -->
    
    <!-- jQuery -->
    <script src="/assets/admin/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="/assets/admin/js/popper.min.js"></script>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <!-- toastr JS -->
    <script src="/assets/admin/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <!-- Custom JS -->
    <script src="/assets/admin/js/script.js"></script>  
</body>
</html>