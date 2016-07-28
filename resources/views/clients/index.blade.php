@extends('layout.master')

@section('title', ' - klienci')

@section('styles')
{{ Html::style('/css/dataTables.bootstrap.min.css') }}
{{ Html::style('/css/index.css') }}
@endsection

@section('content')
<h1>Lista klientów</h1>
@if (isset($success))
  <div class="alert alert-success">{{ $success }}</div>
@elseif (isset($error))
  <div class="alert alert-danger">{{ $error }}</div>
@endif

<table id="table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>L.p.</th>
      <th>Imię i nazwisko</th>
      <th>Adres e-mail</th>
      <th>Telefon</th>
      <th>Firma</th>
      <th>Akcje</th>
    </tr>
  </thead>
  <tbody>
    @if(count($clients) == 0)
	  <tr><td colspan="6">Brak klientów</td></tr>
    @else
	  @foreach($clients as $c)
		<tr>
		  <td></td>
		  <td>{{ $c->firstname }} {{ $c->lastname }}</td>
		  <td><a href='mailto:{{ $c->mail }}'>{{ $c->mail }}</a></td>
		  <td>{{ $c->phone }}</td>
		  <td>{{ (isset($c->company) ? $c->company->name : '') }}</td>
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
