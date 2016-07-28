@extends('layout.master')

@section('title', ' - miasta')

@section('styles')
{{ Html::style('/css/dataTables.bootstrap.min.css') }}
{{ Html::style('/css/index.css') }}
<style>
  div.container { max-width: 550px; }
  td:last-child { width: 130px; }
</style>
@endsection

@section('content')
<h1>Lista miast</h1>
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
	  <th>Akcje</th>
	</tr>
  </thead>
  <tbody>
	@if(count($cities) == 0)
	  <tr><td colspan="3">Brak miast</td></tr>
	@else
	  <?php $i = 1; ?>
	  @foreach($cities as $c)
		<tr>
		  <td>{{ $i++ }}.</td>
		  <td>{{ $c->name }}</td>
		  <td>
			<a class="btn btn-small btn-warning" href="{{ URL::to('cities/'.$c->id.'/edit') }}">Edytuj</a>
			{{ Form::open(array('url' => 'cities/' . $c->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
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
	var x = confirm("Czy na pewno chcesz usunąć te miasto?");
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
