<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MatchingGamers</title>

        <!-- Loading Bootstrap -->
        <link href="{{ url('/') }}/dist/css/vendor/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('/') }}/dist/css/flat-ui.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        @yield('headers')
    </head>
    <body>
      @yield('content')
        @yield('footer_javascript')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
