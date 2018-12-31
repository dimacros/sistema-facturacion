<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>{{ config('app.name', 'Laravel') }}</title>
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
    <!-- Load Scripts -->
    <script src="{{ asset('js/app.js') }}" async></script>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    @include('partials.header')
    <!-- Sidebar menu-->
    @include('partials.sidebar')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>
            <i class="fa fa-dashboard"></i> {{ $title }}
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
    integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
    crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
      (function () {
          "use strict";

          var treeviewMenu = $('.app-menu');

          // Toggle Sidebar
          $('[data-toggle="sidebar"]').click(function(event) {
            event.preventDefault();
            $('.app').toggleClass('sidenav-toggled');
          });

          // Activate sidebar treeview toggle
          $("[data-toggle='treeview']").click(function(event) {
            event.preventDefault();
            if(!$(this).parent().hasClass('is-expanded')) {
              treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
            }
            $(this).parent().toggleClass('is-expanded');
          });

          // Set initial active toggle
          $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

          //Activate bootstrip tooltips
          $("[data-toggle='tooltip']").tooltip();

      })();
    </script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    @stack('scripts')
  </body>
</html>