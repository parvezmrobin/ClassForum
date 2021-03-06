<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clean-blog.css') }}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <style>
        .dropdown-menu > li.notification,
        .dropdown-menu > li > .no-notification {
            width: 33vw;
            min-width: 384px;
        }
        .no-notification {
            cursor: default;
        }

        .navbar-custom .nav li ul.dropdown-menu .no-notification:hover, 
        .navbar-custom .nav li ul.dropdown-menu .no-notification:focus {
            color: #333;
        }
        @media (max-width: 767px) {
            .navbar-header > .nav {
                margin: -5px 5px 0px;
            }
            input[name="key"]{
                color: #337ab7;
            }
        }
        @media (min-width: 768px) {
            input[name="key"]{
                color: white;
            }
        }
    </style>
@yield('style')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
                <img class="img-responsive" style="width: 25px; display: inline; cursor: pointer;" src="{{asset('favicon.ico')}}" alt="">
                <span style="font-size: 1.5em; vertical-align: middle;">Class Forum</span>
            </a>
            @if(Auth::check())
                <div class="nav navbar-nav" style="float: left; ">
                    <form action="{{url('./search')}}" method="get" class="form-horizontal">
                        <div class="floating-label-form-group" style="padding-bottom: 0; padding-top: 12px">
                            <input class="form-control" placeholder="search" type="text" name="key"
                                   style="padding-bottom: 0;">
                        </div>
                    </form>
                </div>
            @endif
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    {{--<li>--}}
                        {{--<a href="{{url('/home')}}" title="Go To Home">--}}
                            {{--<span class="glyphicon glyphicon-home"></span>--}}
                            {{--<span class="hidden-sm">Home</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li>
                        <a href="{{url('/thread/create')}}" title="Create Thread">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span class="hidden-sm">Create</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="See Notifications">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <span class="hidden-sm">Notification ({{Auth::user()->unreadNotifications()->count()}})</span>
                        </a>
                        <ul class="dropdown-menu">
                            @forelse(Auth::user()->unreadNotifications as $notification)
                            <li class="notification">
                                <a href="{{$notification->data["url"]}}?notif_id={{$notification->id}}"
                                   style="white-space:normal;">
                                    {{$notification->data["notification"]}}
                                </a>
                            </li>
                            @empty
                                <li>
                                    <a href="#" class="no-notification">
                                        No new Notification
                                    </a>
                                </li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Logout"
                           >
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="hidden-sm"> {{Auth::user()->name}}</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->is_admin)
                                <li>
                                    <a href="{{url('/admin/dashboard')}}" title="Go To Dashboard">
                                        <span class="glyphicon glyphicon-dashboard"></span>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                            @endif
                                <li>
                                    <a href="{{url('/user/' . Auth::id())}}" title="Go To Profile">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <span>Profile</span>
                                    </a>
                                </li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


@yield('content')


<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright &copy; CSE Discipline {{Date('Y')}}</p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="{{asset('js/app.js')}}"></script>

<!-- Theme JavaScript -->
<script src="{{asset('js/clean-blog.js')}}"></script>
@yield('script')
</body>
</body>
</html>
