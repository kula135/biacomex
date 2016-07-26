@extends('layout.master')

@section('title', ' - firma')

@section('scripts')
<script>

  function ConfirmDelete()
  {
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
  <legend>Dane firmy</legend>
    <strong>Nazwa firmy:</strong> {{ $company->name }}<br>
    <strong>NIP:</strong> {{ $company->nip }}<br>
    <strong>Adres:</strong> {{ $company->address }} {{ ($company->code != '-') ? $company->code : '' }} {{ isset($company->city) ? $company->city->name : '' }}
</fieldset>
<fieldset>
  <legend>Pracownicy</legend>
  <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>L.p.</th>
      <th>Imię i nazwisko</th>
      <th>Adres e-mail</th>
      <th>Telefon</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if(count($company->clients) == 0)
    <tr><td colspan="5">Brak pracownikow</td></tr>
    @else
      <?php $a=1; ?>
      @foreach($company->clients as $client)
      <tr>
        <td>{{ $a++ }}.</td>
        <td>{{ $client->firstname }} {{ $client->lastname }}</td>
        <td><a href='mailto:{{ $client->mail }}'>{{ $client->mail }}</a></td>
        <td>{{ $client->phone }}</td>
        <td style="width: 140px;">
          <a class="btn btn-small btn-warning" href="{{ URL::to('clients/' . $c->id . '/edit') }}">Edytuj</a>
          {{ Form::open(array('url' => 'clients/' . $c->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Usuń', array('class' => 'btn btn-danger')) }}
          {{ Form::close() }}
        </td>
      </tr>
      @endforeach
    @endif
  </tbody>
</table>
</fieldset>

<ul class="pager">
  @if ($previous)
  <li class="previous"><a href="/companies/{{ $previous }}">Poprzedni</a></li>
  @endif
  <li><a class="next" href="{{ URL::to('companies/' . $company->id . '/edit') }}">Edytuj</a></li>
  @if ($next)
  <li class="next"><a href="/companies/{{ $next }}">Następny</a></li>
  @endif
</ul>
@endsection