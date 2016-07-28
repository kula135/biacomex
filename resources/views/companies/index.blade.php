@extends('layout.master')

@section('title', ' - firmy')

@section('styles')
{{ Html::style('/css/dataTables.bootstrap.min.css') }}
{{ Html::style('/css/index.css') }}
@endsection

@section('content')
<h1>Lista firm</h1>
@if (isset($success))
  <div class="alert alert-success">{{ $success }}</div>
@elseif (isset($error))
  <div class="alert alert-danger">{{ $error }}</div>
@endif

<table id="table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>L.p.</th>
      <th>Nazwa</th>
      <th>Nip</th>
      <th>Adres</th>
      <th>Akcje</th>
    </tr>
  </thead>
  <tbody>
    @if(count($companies) == 0)
	  <tr><td colspan="5">Brak firm</td></tr>
    @else
	  @foreach($companies as $c)
		<tr>
		  <td></td>
		  <td>{{ $c->name }}</td>
		  <td>{{ $c->nip }}</td>
		  <td>{{ $c->address }}<br>{{ $c->code }} {{ isset($c->city) ? $c->city->name : '' }}</td>
		  <td>
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
{{ Html::script('/js/index.js') }}

<script>
  function ConfirmDelete() {
	var x = confirm("Czy na pewno chcesz usunąć tą firmę?");
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