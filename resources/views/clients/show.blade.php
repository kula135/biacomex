@extends('layout.master')

@section('title', ' - klienci')

@section('styles')
{{ Html::style('/css/dataTables.bootstrap.min.css') }}
{{ Html::style('/css/index.css') }}
@endsection

@section('content')
<h1>Klient</h1>

@if (isset($success))
  <div class="alert alert-success">{{ $success }}</div>
@elseif (isset($error))
  <div class="alert alert-danger">{{ $error }}</div>
@endif

<fieldset>
  <legend>Dane klienta</legend>
  <strong>Imię i nazwisko:</strong> {{ $client->firstname }} {{ $client->lastname }}<br>
  <strong>Adres e-mail:</strong> <a href='mailto:{{ $client->mail }}'>{{ $client->mail }}</a><br>
  <strong>Telefon:</strong> {{ $client->phone }}<br>
  <strong>Firma:</strong> {!! (isset($client->company) ? "<a href='companies/".$client->company->id."'>".$client->company->name."</a>" : '-') !!}
</fieldset>
<fieldset>
  <legend>Zarejestowane zlecenia</legend>
  <table id="table" class="table table-striped table-bordered">
	<thead>
	  <tr>
		<th rowspan="2">L.p.</th>
		<th colspan="2">Trasa</th>
		<th colspan="2">Czas</th>
		<th rowspan="2">Cena</th>
		<th rowspan="2">Akcje</th>
	  </tr>
	  <tr>
		<th>Z</th>
		<th>Do</th>
		<th>Od</th>
		<th>Do</th>
	  </tr>
	</thead>
	<tbody>
	  @if(count($client->orders) == 0)
		<tr><td colspan="7">Brak zleceń</td></tr>
	  @else
		@foreach($client->orders as $o)
		  <tr>
			<td></td>
			<td>{{ $o->tripfrom->name }}</td>
			<td>{{ $o->tripto->name }}</td>
			<td>{{ $o->datefrom }}</td>
			<td>{{ $o->dateto }}</td>
			<td>{{ $o->price }}</td>
			<td>
			  <a class="btn btn-small btn-success" href="{{ URL::to('orders/' . $o->id) }}">Pokaż</a>
			  <a class="btn btn-small btn-warning" href="{{ URL::to('orders/' . $o->id . '/edit') }}">Edytuj</a>
			  {{ Form::open(array('url' => 'orders/' . $o->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
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
  <li class="previous"><a href="{{ URL::to('clients/' . $previous) }}">Poprzedni</a></li>
  @endif
  <li><a class="next" href="{{ URL::to('clients/' . $client->id . '/edit') }}">Edytuj</a></li>
  @if ($next)
  <li class="next"><a href="{{ URL::to('clients/' .  $next) }}">Następny</a></li>
  @endif
</ul>
@endsection

@section('scripts')
{{ Html::script('/js/jquery.dataTables.min.js') }}
{{ Html::script('/js/dataTables.bootstrap.min.js') }}
{{ Html::script('/js/index.js') }}

<script>
  function ConfirmDelete() {
	var x = confirm("Czy na pewno chcesz usunąć to zlecenie?");
	if (x)
	  return true;
	else
	  return false;
  }
</script>

@if (isset($success) || isset($error))
  <script>
	$(function () {
	  setTimeout(function () {
		$(".alert").hide(1000)
	  }, 5000);
	});
  </script>
@endif
@endsection
