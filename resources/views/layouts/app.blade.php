<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Fase2Spa') }}</title>
    
    @include('layouts.styles')
    @yield('styles')
</head>
<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <span class="logo-mini"><img src="{{ asset('img/logo-fase2.png') }}"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
            <img width="60px" src="{{ asset('img/logo-fase2.png') }}">

          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a>{{ Auth::user()->name }}</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            Cerrar sesión
                        </a>  
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
          </div>
        </nav>
      </header>
    @guest
        @yield('content')
    @else
        <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> 
                <span>Clientes</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> 
                <span>Clientes</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> 
                <span>Clientes</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> 
                <span>Clientes</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Administracion</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="/"><i class="fa fa-circle-o"></i> Roles</a></li>
                <li><a href="/"><i class="fa fa-circle-o"></i> Permisos</a><li>
                <li class="treeview">
                  <a href="#">
                    <span>Catalogos</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="/"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                    <li><a href="/"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li><a href="/"><i class="fa fa-circle-o"></i> Permisos</a><li>
                  </ul>
                </li>
              </ul>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.1
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="#">power by Ruravi.App</a>.</strong> All rights
        reserved.
      </footer>
    @endguest
    </div>
    <!-- ./wrapper -->

    @include('layouts.javascripts')
    @yield('javascripts')
</body>
</html>
