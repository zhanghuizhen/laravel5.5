{{--<!DOCTYPE html>--}}
{{--<html lang="{{ app()->getLocale() }}">--}}
{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

    {{--<!-- CSRF Token -->--}}
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

    {{--<!-- Styles -->--}}
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
    {{--<div id="app">--}}
        {{--<nav class="navbar navbar-default navbar-static-top">--}}
            {{--<div class="container">--}}
                {{--<div class="navbar-header">--}}

                    {{--<!-- Collapsed Hamburger -->--}}
                    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">--}}
                        {{--<span class="sr-only">Toggle Navigation</span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                    {{--</button>--}}

                    {{--<!-- Branding Image -->--}}
                    {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                        {{--{{ config('app.name', 'Laravel') }}--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="nav navbar-nav">--}}
                        {{--&nbsp;--}}
                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@guest--}}
                            {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                            {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                        {{--@else--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<ul class="dropdown-menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('logout') }}"--}}
                                            {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                            {{--Logout--}}
                                        {{--</a>--}}

                                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                            {{--{{ csrf_field() }}--}}
                                        {{--</form>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--@endguest--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        {{--@yield('content')--}}
    {{--</div>--}}

    {{--<!-- Scripts -->--}}
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}


<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('js/bootstrap.js')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/bootstrap.min.js')}}">


    <meta charset="UTF-8">
    <style>
        .span9 table td{
            text-align: center;
            vertical-align:middle;
        }


    </style>
</head>
<body>
@section('sidebar')
@show

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">社区生活服务后台管理系统</a>

            <div class="btn-group pull-right">
                <a class="btn" href="my-profile.html"><i class="icon-user"></i> 欢迎您 {{session('logined_username')}}</a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('admin/user/show', ['id' => session('logined_id')])}}">查看个人资料</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>

            {{--<div class="nav-collapse">--}}
                {{--<ul class="nav">--}}
                    {{--<li><a href="index.html">Home</a></li>--}}
                    {{--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="new-user.html">New User</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li><a href="users.html">Manage Users</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="new-role.html">New Role</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li><a href="roles.html">Manage Roles</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="stats.html">Stats</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}

        </div>
    </div>
</div>

<div class="container-fluid" >
    <div class="row-fluid" >
        <div class="span3" style="height:400px">
            <div class="well sidebar-nav" style="height:400px;background: white">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="success"><a href="#">主页</a></li>
                    <li role="presentation"><a href="{{url('admin/user/index')}}">用户管理</a></li>
                    <li role="presentation"><a href="{{url('admin/notice/index')}}">小区公告管理</a></li>
                    <li role="presentation"><a href="{{url('admin/service/index')}}">生活服务管理</a></li>
                    <li role="presentation"><a href="{{url('admin/repair/index')}}">报修管理</a></li>
                    <li role="presentation"><a href="{{url('admin/suggest/index')}}">投诉建议管理</a></li>
                    <li role="presentation"><a href="{{url('admin/topic/index')}}">社区动态管理</a></li>
                    <li role="presentation"><a href="{{url('admin/comment/index')}}">评论管理</a></li>
                </ul>

            </div>
        </div>

        <div class="span9">
            @yield('content')
        </div>

    </div>



</div>




    <hr>

    <footer class="well" style="text-align: center">
        社区服务管理系统
        <a href="http://software.hebtu.edu.cn/" target="_blank" title="软件学院"> @河北师范大学软件学院</a>
    </footer>



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>