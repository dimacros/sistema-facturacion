<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Niconne" rel="stylesheet">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    @include('partials.header')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" 
        src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{ auth()->user()->first_name }}</p>
          <p class="app-sidebar__user-designation">{{ auth()->user()->roleName() }}</p>
        </div>
      </div>
      @isset($type)
        @include('partials.menus.' . $type)
      @else
        @include('partials.menus.admin')
      @endisset
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>
            <i class="fa fa-{{ $icon ?? 'dashboard' }}"></i> @yield('title')
          </h1>
          <p>Start a beautiful journey here</p>
        </div>
        <!-- Optional Navigation
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item">
            <i class="fa fa-home fa-lg"></i>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Blank Page</a>
          </li>
        </ul>-->
      </div>
      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
      integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    @stack('scripts')
  </body>
</html>