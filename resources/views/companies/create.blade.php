@extends('layout.master')

@section('title', ' - firmy')

@section('styles')
{{ Html::style('/css/jquery-ui.min.css') }}
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Nowa firma</h1>
@if (count($errors) > 0)
  <div class="alert alert-danger">
	<h3>Formularz zawiera błędy:</h3>
	<ul>
	  @foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	  @endforeach
	</ul>
  </div>
@endif

{{ Form::open(array('url' => 'companies')) }}
{{ Form::token() }}

{{ Form::label('name', 'Nazwa firmy', ['class' => 'required']) }}
{{ Form::text('name', null, ['required' => true]) }}

{{ Form::label('nip', 'NIP', ['class' => 'required']) }}
{{ Form::text('nip', null, ['placeholder' => 'xxx-xxx-xx-xx', 'required' => true]) }}

{{ Form::label('address', 'Adres') }}
{{ Form::text('address') }}

<table>
  <tr>
	<td width="30%">
	  {{ Form::label('code', 'Kod pocztowy') }}
	  {{ Form::text('code', null, ['placeholder' => 'xx-xxx']) }}
	</td>
	<td width="1%"></td>
	<td>
	  {{ Form::label('city', 'Miejscowość') }}
	  {{ Form::text('city', null, ['id' => 'city']) }}
	</td>
  </tr>
</table>

{{ Form::submit('Zapisz') }}

{{ Form::close() }}

@endsection

@section('scripts')
{{ Html::script('/js/autosuggest.js') }}
{{ Html::script('/js/jquery-ui.min.js') }}
<script>
  $(document).ready(function () {
	new bsn.AutoSuggest('city', cities);
  });

  var cities = {
	script: function (name) {
	  return "/cities/hint/" + name;
	},
	varname: "name",
	json: true,
	delay: 250,
	timeout: 5000,
	noresults: "Brak podpowiedzi, zostanie dodana nowa miejscowość"
  };
</script>
@endsection
