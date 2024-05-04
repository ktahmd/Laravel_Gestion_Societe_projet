<!doctype html>
<html lang="fr" class="fullscreen-bg">

<head>
    <title>Login | G.S</title>
    <!-- Log on to codeastro.com for more projects! -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
</head>
    <body>

        <body class="custom-body">
            <!-- WRAPPER -->
      <div id="wrapper">
          <div class="vertical-align-wrap">
              <div class="vertical-align-middle">
                  <div class="auth-box ">
                      <div class="left">
                          <div class="content">
                            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                                <!-- Page Content -->
                                <main>
                                    {{ $slot }}
                                </main>
                            </div>
                          </div>
                      </div>
                      <div class="right">
                          <div class="overlay"></div>
                          <div class="content text">
                          <div class="logo-container">
                             <div align=center >
                            @include('profile.partials.update-password-form')
                             
                            
                             </div>
                          </div>
                          </div>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>
      </div>

 

    </body>
</html>

