<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <title>{{ config('app.name', 'Laravel') }}</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Main CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Niconne" rel="stylesheet">
      <!-- Font-icon css-->
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    @yield('content')
    <!-- Essential javascripts for application to work-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
  </body>
</html>