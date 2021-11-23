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
                                <form action="{{ route('reset.password.post') }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="token" value="{{ $token }}">
          
                                  <div class="form-group">
                                      <label for="email_address" class="required">E-Mail Address</label>
                                      
                                          <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                          @if ($errors->has('email'))
                                              <span class="text-danger">{{ $errors->first('email') }}</span>
                                          @endif
                                      
                                  </div>

          
                                  <div class="form-group">
                                      <label for="password" class="required">Password</label>
                                      
                                          <input type="password" id="password" class="form-control" name="password" required autofocus>
                                          @if ($errors->has('password'))
                                              <span class="text-danger">{{ $errors->first('password') }}</span>
                                          @endif
                                      
                                  </div>
          
                                  <div class="form-group">
                                      <label for="password-confirm" class="required">Confirm Password</label>
                                      
                                          <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                          @if ($errors->has('password_confirmation'))
                                              <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                          @endif
                                      
                                  </div>
          
                                      <button type="submit" class="btn btn-primary btn-block">
                                          Reset Password
                                      </button>
                                      
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