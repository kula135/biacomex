<!DOCTYPE html>
<html>
  <head>
    <title>Biacomex @yield('title')</title>
    {{ Html::style('/css/bootstrap.min.css') }}
    {{ Html::style('/css/main.css') }}
    @yield('styles')
  </head>
  <body>
    <nav class="navbar">
      <div style="max-width: 1024px; margin: 0 auto;">
        <div class="navbar-header">
          <a href="{{ URL::to('orders') }}"><img src="/img/logo.jpg" alt="Biacomex" style="height: 50px;"></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a class="navbar-brand" href="{{ URL::to('orders') }}" style="display: block;">Rejestr zleceń</a></li>
          <li><a class="navbar-brand" href="{{ URL::to('orders/create') }}">Nowe zlecenie</a></li>
          <li><a href="{{ URL::to('companies') }}">Firmy</a></li>
          <li><a href="{{ URL::to('clients') }}">Osoby</a></li>
          <li><a href="{{ URL::to('cities') }}">Miasta</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      @yield('content')
    </div>
    <footer style="height: 30px;"></footer>
	{{ Html::script('/js/jquery-1.12.4.js') }}
    {{ Html::script('/js/bootstrap.min.js') }}
	@yield('scripts')
  </body>
</html>