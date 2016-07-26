@extends('layout.master')

@section('title', ' - firma')

@section('scripts')
<script>

  function ConfirmDelete() {
	var x = confirm("Czy na pewno chcesz usunąć tego pracownika? Jeżeli do pracownika przypisane są jakieś zlecenia operacja nie powiedzie się.");
	if (x)
	  return true;
	else
	  return false;
  }

</script>
@endsection

@section('content')
<h1>Firma {{ $company->name }}</h1>

<fieldset>
  <legend>Dane klienta</legend>
  <strong>Imię i nazwisko:</strong> {{ $client->firstname }} {{ $client->lastname }}<br>
  <strong>Adres e-mail:</strong> <a href='mailto:{{ $client->mail }}'>{{ $client->mail }}</a><br>
  <strong>Telefon:</strong> {{ $client->phone }}<br>
  <strong>Firma:</strong> {{ (isset($client->company) ? $client->company->name : '') }}<br>
</fieldset>

<ul class="pager">
  @if ($previous)
  <li class="previous"><a href="{{ URL::to('clients/' . $previous }}">Poprzedni</a></li>
  @endif
  <li><a class="next" href="{{ URL::to('clients/' . $company->id . '/edit') }}">Edytuj</a></li>
  @if ($next)
  <li class="next"><a href="{{ URL::to('clients/' .  $next }}">Następny</a></li>
  @endif
</ul>
@endsection