@extends('layout.master')

@section('title', ' - lista klientów')

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
<h1>Lista klientów</h1>
@if (isset($message))
<div class="alert alert-success">
  {{ $message }}
</div>
@endif
<table id="table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>L.p.</th>
      <th>Imię i nazwisko</th>
      <th>Adres e-mail</th>
      <th>Telefon</th>
      <th>Firma</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if(count($clients) == 0)
    <tr><td colspan="6">Brak klientów</td></tr>
    @else
	<?php $a = 1; ?>
	@foreach($clients as $client)
	<tr>
	  <td>{{ $a++ }}.</td>
	  <td>{{ $client->firstname }} {{ $client->lastname }}</td>
	  <td><a href='mailto:{{ $client->mail }}'>{{ $client->mail }}</a></td>
	  <td>{{ $client->phone }}</td>
	  <td>{{ (isset($client->company) ? $client->company->name : '') }}</td>
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
	var x = confirm("Czy na pewno chcesz usunąć tego pracownika? Jeżeli do pracownika przypisane są jakieś zlecenia operacja nie powiedzie się.");
	if (x)
	  return true;
	else
	  return false;
  }
</script>
@endsection
