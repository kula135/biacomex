<!DOCTYPE html>
<html>
  <head>
    <title>Biacomex - @yield('title')</title>
    {{ Html::script('/js/jquery-1.12.4.js') }}
    {{ Html::script('/js/bootstrap.min.js') }}
    {{ Html::style('/css/bootstrap.min.css') }}
    {{ Html::style('/css/main.css') }}
    @yield('style')
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <a href="{{ URL::to('orders') }}"><img src="/img/logo.jpg" alt="Biacomex" style="height: 50px;"></a>
      </div>
      <ul class="nav navbar-nav">
        <li><a class="navbar-brand" href="{{ URL::to('orders') }}" style="display: block;">Rejestr zleceń</a></li>
        <li><a href="{{ URL::to('orders') }}">Wyświetl zlecenia</a></li>
        <li><a href="{{ URL::to('orders/create') }}">Nowe zlecenie</a>
      </ul>
    </nav>
    <div class="container">
      @yield('content')
    </div>
  </body>
</html>