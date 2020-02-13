<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WelCome To TunTun Chat</title>
    {{-- <link rel="icon" type="image/png" href="{{ asset('appImage/icon.png') }}"/> --}}
    <link rel="icon" type="image/png" href="{!! asset('appImage/icon.png') !!}"/>
    <!-- Font Icon -->
    <!-- <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css"> -->

    <!-- Main css -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginReg.css') }}">
    <style>
        .alert {
          padding: 20px;
          background-color: #f44336;
          color: white;
        }
        
        .closebtn {
          margin-left: 15px;
          color: white;
          font-weight: bold;
          float: right;
          font-size: 22px;
          line-height: 20px;
          cursor: pointer;
          transition: 0.3s;
        }
        
        .closebtn:hover {
          color: black;
        }
    </style>
    
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                @error('email')
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                @error('password')
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('appImage/login.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log In</h2>
                        <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="fas fa-user"></i></label>
                                <input type="email" name="email" id="your_name" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="fa fa-key"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password" required autocomplete="current-password"/>
                                {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> --}}
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        {{-- <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>