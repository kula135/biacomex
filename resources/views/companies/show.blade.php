@extends('layout.master')

@section('title', ' - firmy')

@section('styles')
{{ Html::style('/css/dataTables.bootstrap.min.css') }}
{{ Html::style('/css/index.css') }}

<style>
  #table1 {
	width: 100%;
  }
</style>
@endsection

@section('content')
<h1>Firma</h1>

@if (isset($success))
<div class="alert alert-success">{{ $success }}</div>
@elseif (isset($error))
<div class="alert alert-danger">{{ $error }}</div>
@endif

<fieldset>
  <legend>Dane firmy</legend>
  <strong>Nazwa firmy:</strong> {{ $company->name }}<br>
  <strong>NIP:</strong> {{ $company->nip }}<br>
  <strong>Adres:</strong> {{ $company->address }}, {{ ($company->code != '-') ? $company->code : '' }} {{ isset($company->city) ? $company->city->name : '' }}
</fieldset>
<fieldset>
  <ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#clients">Pracownicy</a></li>
	<li><a data-toggle="tab" href="#orders">Zlecenia</a></li>
  </ul>
  <div class="tab-content">
	<div id="clients" class="tab-pane fade in active">
	  <table id="table" class="table table-striped table-bordered">
		<thead>
		  <tr>
			<th>L.p.</th>
			<th>Imię i nazwisko</th>
			<th>Adres e-mail</th>
			<th>Telefon</th>
			<th>Akcje</th>
		  </tr>
		</thead>
		<tbody>
		  @if(count($company->clients) == 0)
		  <tr><td colspan="5">Brak pracownikow</td></tr>
		  @else
		  @foreach($company->clients as $c)
		  <tr>
			<td></td>
			<td>{{ $c->firstname }} {{ $c->lastname }}</td>
			<td><a href='mailto:{{ $c->mail }}'>{{ $c->mail }}</a></td>
			<td>{{ $c->phone }}</td>
			<td>
			  <a class="btn btn-small btn-success" href="{{ URL::to('clients/' . $c->id) }}">Pokaż</a>
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
	</div>
	<div id="orders" class="tab-pane fade">
	  <table id="table1" class="table table-striped table-bordered" style="width: 100%">
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
		  @if(count($company->orders) == 0)
		  <tr><td colspan="7">Brak zleceń</td></tr>
		  @else
		  @foreach($company->orders as $o)
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
	</div>
  </div>
</fieldset>

<ul class="pager">
  @if ($previous)
  <li class="previous"><a href="{{ URL::to('companies/' . $previous) }}">Poprzedni</a></li>
  @endif
  <li><a class="next" href="{{ URL::to('companies/' . $company->id . '/edit') }}">Edytuj</a></li>
  @if ($next)
  <li class="next"><a href="{{ URL::to('companies/' . $next) }}">Następny</a></li>
  @endif
</ul>

@endsection

@section('scripts')
{{ Html::script('/js/jquery.dataTables.min.js') }}
{{ Html::script('/js/dataTables.bootstrap.min.js') }}
{{ Html::script('/js/index.js') }}

<script>
  function ConfirmDelete() {
	var x = confirm("Czy na pewno chcesz usunąć tego klienta?");
	if (x)
	  return true;
	else
	  return false;
  }

  $(function () {
	setTimeout(function () {
	  $(".alert").hide(1000)
	}, 5000);
  });

  $(document).ready(function () {
	var t1 = $('#table1').DataTable({
	  "info": false,
	  "bSort": true,
	  "language": {
		"processing": "Przetwarzanie...",
		"search": "Szukaj:",
		"lengthMenu": "Pokaż _MENU_ pozycji",
		"info": "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
		"infoEmpty": "Pozycji 0 z 0 dostępnych",
		"infoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
		"infoPostFix": "",
		"loadingRecords": "Wczytywanie...",
		"zeroRecords": "Nie znaleziono pasujących pozycji",
		"emptyTable": "Brak danych",
		"paginate": {
		  "first": "Pierwsza",
		  "previous": "Poprzednia",
		  "next": "Następna",
		  "last": "Ostatnia"
		},
		"aria": {
		  "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
		  "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
		}
	  },
	  "columnDefs": [{
		  "searchable": false,
		  "orderable": false,
		  "targets": 0
		}],
	  "order": [[1, 'asc']]
	});

	t1.on('order.dt search.dt', function () {
	  t1.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
		cell.innerHTML = i + 1 + ".";
	  });
	}).draw();
  });
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
