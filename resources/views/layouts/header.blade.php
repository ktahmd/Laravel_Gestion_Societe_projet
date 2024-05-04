
<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{asset('logo/societelogo.png')}}" width="45%"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Gestion</b> societe</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- search form (Optional) -->
        
        {{-- <form action="#" method="get" class="sidebar-form"  style="width: 200px;>
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>  --}}
        
        <!-- /.search form -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset('user-profile.png') }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ \Auth::user()->name  }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">

                            <p>
                                {{ \Auth::user()->name  }}
                                <small>{{ \Auth::user()->email  }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{--<div class="pull-left">--}}
                            {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                            {{--</div>--}}
                            <div class="pull-right">
                                <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            
                                <!-- Add the button for editing profile below the logout button -->
                                <a class="btn btn-primary btn-flat" href="{{ route('profile.edit') }}">
                                    {{ __('Edit Profile') }}
                                </a>
                            </div>
                            
                            <br>
                            {{-- <div class="pull-right">
                                <a class="btn btn-danger btn-flat" href="{{ route('profile.edit') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('profile.edit').submit();">
                                    {{ __('edit profil') }}
                                </a>
                        
                                <form id="logout-form" action="{{ route('profile.edit') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div> --}}
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
