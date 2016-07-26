@extends('layout.master')

@section('title', ' - wszystkie zamówienia')

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
<h1>Lista zleceń</h1>
@if (isset($message))
<div class="alert alert-success">
  {{ $message }}
</div>
@endif
<table id="table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th rowspan="2">L.p.</th>
      <th colspan="2">Trasa</th>
      <th colspan="2">Czas</th>
      <th rowspan="2"></th>
    </tr>
    <tr>
      <th>Z</th>
      <th>Do</th>
      <th>Od</th>
      <th>Do</th>
    </tr>
  </thead>
  <tbody>
    @if(count($orders) == 0)
    <tr><td colspan="6">Brak zleceń</td></tr>
    @else
	<?php $a = 1; ?>
	@foreach($orders as $key => $value)
	<tr>
	  <td>{{ $a++ }}.</td>
	  <td>{{ $value->tripfrom->name }}</td>
	  <td>{{ $value->tripto->name }}</td>
	  <td>{{ $value->datefrom }}</td>
	  <td>{{ $value->dateto }}</td>
	  <td style="width: 212px;">
		<a class="btn btn-small btn-success" href="{{ URL::to('orders/' . $value->id) }}">Pokaż</a>
		<a class="btn btn-small btn-warning" href="{{ URL::to('orders/' . $value->id . '/edit') }}">Edytuj</a>
		{{ Form::open(array('url' => 'orders/' . $value->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
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
	var x = confirm("Czy na pewno chcesz usunąć to zlecenie?");
	if (x)
	  return true;
	else
	  return false;
  }

</script>
@endsection
