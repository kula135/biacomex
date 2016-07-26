@extends('layout.master')

@section('title', ' - lista miast')

@section('scripts_and_styles')
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
</script>
@endsection

@section('content')
<h1>Lista miast</h1>
@if (isset($message))
<div class="alert alert-success">
  {{ $message }}
</div>
@endif
<div class="tablewidth">
  <table id="table" class="table table-striped table-bordered" style="max-width: 400px; margin: 0 auto;" >
	<col style="width: 10%">
	<col>
	<col style="width: 15%">
	<thead>
	  <tr>
		<th>L.p.</th>
		<th>Nazwa</th>
		<th></th>
	  </tr>
	</thead>
	<tbody>
	  @if(count($cities) == 0)
	  <tr><td colspan="3">Brak miast</td></tr>
	  @else
	  <?php $a = 1; ?>
	  @foreach($cities as $value)
	  <tr>
		<td>{{ $a++ }}.</td>
		<td>{{ $value->name }}</td>
		<td style="width: 212px;"><a class="btn btn-small btn-warning" href="{{ URL::to('cities/'.$value->id.'/edit') }}">Edytuj</a></td>
	  </tr>
	  @endforeach
	  @endif
	</tbody>
  </table>
</div>
@endsection