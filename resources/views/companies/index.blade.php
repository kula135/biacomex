@extends('layout.master')

@section('title', ' - lista firm')

@section('styles')
{{ Html::style('/css/dataTables.bootstrap.min.css') }}
<style>
  div.tablewidth {
	max-width: 500px;
	margin: 0 auto;
  }

  .table > tbody > tr > td, .table > tbody > tr > th {
	vertical-align: middle;
  }

  .col-sm-7 {
    width: 100%;
  }

  div.dataTables_wrapper div.dataTables_paginate {
	text-align: center;
  }

</style>
@endsection

@section('content')
<h1>Lista firm</h1>
@if (isset($message))
<div class="alert alert-success">
  {{ $message }}
</div>
@endif
<table id="table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>L.p.</th>
      <th>Nazwa</th>
      <th>Nip</th>
      <th>Adres</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if(count($orders) == 0)
    <tr><td colspan="5">Brak zleceń</td></tr>
    @else
	<?php $a = 1; ?>
	@foreach($companies as $c)
	<tr>
	  <td>{{ $a++ }}.</td>
	  <td>{{ $c->name }}</td>
	  <td>{{ $c->nip }}</td>
	  <td>{{ $c->address }}<br>{{ $c->code }} {{ $c->city->name }}</td>
	  <td style="width: 212px;">
		<a class="btn btn-small btn-success" href="{{ URL::to('companies/' . $c->id) }}">Pokaż</a>
		<a class="btn btn-small btn-warning" href="{{ URL::to('companies/' . $c->id . '/edit') }}">Edytuj</a>
		{{ Form::open(array('url' => 'companies/' . $c->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
		{{ Form::hidden('_method', 'DELETE') }}
		{{ Form::submit('Usuń', array('class' => 'btn btn-danger')) }}
		{{ Form::close() }}
	  </td>
	</tr>
	@endforeach
    @endif
  </tbody>
</table>
@endsection

@section('scripts')
{{ Html::script('/js/jquery.dataTables.min.js') }}
{{ Html::script('/js/dataTables.bootstrap.min.js') }}
<script>
  $(document).ready(function () {
	$('#table').DataTable({
	  "info": false,
	  "bSort": false,
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
	  }
	});
  });

  function ConfirmDelete() {
	var x = confirm("Czy na pewno chcesz usunąć tą firmę? Jeżeli do firmy przypisane są jakieś zlecenia operacja nie powiedzie się.");
	if (x)
	  return true;
	else
	  return false;
  }

</script>
@endsection