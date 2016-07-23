@extends('layout.master')

@section('title', 'Wyświetl zamówienie')

@section('content')
<h1>Zamówienie nr {{ $order->id }}</h1>

<fieldset>
  <legend>Zamawiający - 
    {{ $order->company ? 'firma' : 'osoba prywatna' }}
  </legend>
  <!--  @if ($order->company)
      <strong>NIP:</strong> {{ $order->nip }}<br>
      <strong>Nazwa firmy:</strong> {{ $order->name }}<br>
      <strong>Adres:</strong> {{ $order->address }}<br>
      <strong>Adres:</strong> {{ $order->code }} {{ $order->city }}<br>
      <h4>Osoba kontaktowa</h4>
    @endif
    <strong>Imię i nazwisko:</strong> {{ $order->firstname }} {{ $order->lastname }}<br>
    <strong>Adres e-mail:</strong> {{ $order->mail }}<br>
    <strong>Telefon:</strong> {{ $order->phone }}<br>-->
</fieldset>
<fieldset>
  <legend>Trasa</legend>
  <strong>Z:</strong> {{ $order->tripfrom ?: '-' }}<br>
  <strong>Do:</strong> {{ $order->tripto ?: '-' }}<br>
  <strong>Dystans:</strong> {{ $order->distance ?: '-' }}<br>
  <strong>Dodatkowe informacje:</strong> {{ $order->tripinfo ?: '-' }}<br>
</fieldset>
<fieldset>
  <legend>Data wyjazdu</legend>
  <strong>Od:</strong> {{ $order->datefrom ?: '-' }}<br>
  <strong>Do:</strong> {{ $order->dateto ?: '-' }}<br>
</fieldset>
<fieldset>
  <legend>Szczegóły</legend>
  {{ $order->description ?: '-' }}
</fieldset>
<fieldset>
  <legend>Ilość osób</legend>
  {{ $order->count ?: '-' }}
</fieldset>
<fieldset>
  <legend>Środek transportu</legend>
  {{ $order->vehicle ?: '-' }}
</fieldset>
<fieldset>
  <legend>Cena</legend>
  <strong>Całkowita:</strong> {{ $order->price ?: '-' }}<br>
  <strong>Szczegóły:</strong> {{ $order->priceinfo ?: '-' }}<br>
</fieldset>
<fieldset>
  <legend>Zlecenie</legend>
  <strong>Data otrzymania:</strong> {{ $order->requestdate ?: '-' }}<br>
  <strong>Data odpowiedzi:</strong> {{ $order->answerdate ?: '-' }}<br>
</fieldset>
<ul class="pager">
  @if ($previous)
  <li class="previous"><a href="/orders/{{ $previous }}">Poprzedni</a></li>
  @endif
  <li><a class="next" href="{{ URL::to('orders/' . $order->id . '/edit') }}">Edytuj</a></li>
  @if ($next)
  <li class="next"><a href="/orders/{{ $next }}">Następny</a></li>
  @endif
</ul>
@endsection