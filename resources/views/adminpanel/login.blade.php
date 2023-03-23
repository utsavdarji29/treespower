<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Adminpanel</title>
    <link rel="stylesheet" href="{{ asset('managerpanel/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/fontawesome-all.css') }}" >
    <link rel="stylesheet" href="{{ asset('managerpanel/css/searchboxstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('managerpanel/css/responsive.css') }}" >
    <style type="text/css">
        .info {
                color: darkblue;
                font-size: 20px;
                border: none;
                text-decoration: none;
          }
    </style>
</head>
<body>
    <div class="main" id="main-site" style="background-image: url('{{ asset('managerpanel/images/login-bg.png')}}');">
        <div class="login-page-main">
            <div class="login-header">
                <div class="logo">
                    <a href="javascript:;">
                        <img src="{{ asset('managerpanel/images/Logo_img.png') }}">
                    </a>
                </div>
            </div>
            <div class="login-form-part-main">
                <div class="login-form-head">
                    <h2>SIGN IN:</h2>
                </div>
                <?php
                    $formURL = route('adminpanel.submitlogin');
                ?>
                @if($errors->any())
                    <div class="error-message-box">                    
                        <p>{{$errors->first()}}</p>
                    </div>
                @endif
                @if(session()->has('email'))
                    <?php print_r(session()->all()); ?>
                @endif
                <div class="login-form-dtl-main">
                    <form action="{{ $formURL }}" method="POST" id="logForm">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="login-form-inp-box login-form-emal-inp">
                            <input type="text" name="email" value="{{ old('email') }}" class="login-inp" placeholder="Email Address" required="">
                        </div>
                        <div class="login-form-inp-box">
                            <input type="password" name="password" class="login-inp" placeholder="Password">
                        </div>
                        <div class="login-fo-pwd">
                            <a href="javascript:;" id="showFP">Forgot password?</a>
                        </div>
                        <div class="login-sing-in">
                            <a href="javascript:;"><img src="{{ asset('managerpanel/images/lock.png') }}"><button class="btn info" type="submit" value="SIGN IN">SIGN IN</button></a>
                        </div>
                    </form>
                </div>
                <?php
                $forgotURL = route('adminpanel.forgotpassword');
                ?>
               
                <div class="login-right-desc-main" id="forgotPassword" style="display: none;">
                    <form action="{{ $forgotURL }}" method="POST" id="forgotForm">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="login-form-head">
                            <h2>Forgot Password:</h2>
                        </div>
                        <div class="login-form-dtl-main">
                                <div class="login-form-inp-box login-form-emal-inp">
                                    <input type="text" name="forgotEmail" class="login-inp" placeholder="Email Address" required="">
                                </div>
                                <div class="for-pass">
                                    <button class="btn info" type="submit" value="SEND">SEND</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('managerpanel/js/jquery.min.js') }}"></script>
    <script src="{{ asset('managerpanel/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('managerpanel/js/slick.min.js') }}"></script>
    <script>
    $(document).ready(function(){
        $('#menu-icon').click(function(){
            $(this).toggleClass('menu-open');
            $(".menu-main").slideToggle();
        });
    });

    $("#showFP").click(function() {
        $("#login").css("display","none");
        $("#forgotPassword").css("display","block");
    });

    $("#showLogin").click(function() {
        $("#forgotPassword").css("display","none");
        $("#login").css("display","block");
    });
    </script>
</body>
</html>