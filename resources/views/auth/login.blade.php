<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | G.S</title>
    <style>
        /* .custom-body {
            background-image: url('{{ asset('background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
           
        }
        .custom-body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(9, 26, 13, 0.81); 
        } */
    </style>
    <!-- Log on to codeastro.com for more projects! -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    {{-- <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}"> --}}
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
</head>

<body class="custom-body">
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <!-- <div class="logo text-center"><img src="{{asset('assets/img/logo-dark.png')}}" alt="IMS Logo"></div> -->
                                <p class="lead">Login to your account</p>
                            </div>
<form class="form-auth-small" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="username" class="control-label sr-only">Username</label>
        <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" value="{{ old('username') }}" required placeholder="username">
        <x-input-error :messages="$errors->get('username')" class="mt-2" style="color: red;" />
    </div>
    <!-- Log on to codeastro.com for more projects! -->
    <div class="form-group">
        <label for="password" class="control-label sr-only">Password</label>
        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Password">
        <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red;" />
    </div>
    <div class="form-group clearfix">
        <label class="fancy-checkbox element-left">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span>Remember me</span>
        </label>
    </div>
    <button type="submit" class="btn btn-success btn-lg btn-block">LOGIN</button>
    <div class="bottom">
        @if (Route::has('password.request'))
        <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">oubliez password?</a></span>
        @endif
    </div> 
</form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                        <div class="logo-container">
                            <img class="heading" src="{{asset('logo/societelogob.png')}}" alt="SOCIETE LOGO" width="80px">
                        </div>
                        <br>
                            <h1 class="heading" align=center><b><span class="larger-text">Gestion de Societe</span></b></h1>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>
<script type="text/javascript">
   $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>

</html>
