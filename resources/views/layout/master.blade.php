<html>
  <head>
    <title>Biacomex - @yield('title')</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
  </head>
  <body>
    @section('sidebar')
    This is the master sidebar.
    @show

    <div class="container">
      @yield('content')
    </div>
  </body>
</html>