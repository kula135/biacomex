@extends('layout.master')

@section('title', ' - klienci')

@section('styles')
{{ Html::style('/css/jquery-ui.min.css') }}
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Edycja danych klienta</h1>
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

{{ Form::model($client, array('route' => array('clients.update', $client->id), 'method' => 'PUT')) }}
{{ Form::token() }}

{{ Form::label('mail', 'Adres e-mail', ['class' => 'required']) }}
{{ Form::email('mail', null, ['required' => true]) }}
<table>
  <tr>
	<td>
	  {{ Form::label('firstname', 'Imię') }}
	  {{ Form::text('firstname') }}
	</td>
	<td width="1%"></td>
	<td>
	  {{ Form::label('lastname', 'Nazwisko') }}
	  {{ Form::text('lastname') }}
	</td>
  </tr>
</table>
{{ Form::label('phone', 'Telefon') }}
{{ Form::tel('phone') }}

{{ Form::label('', 'Nazwa firmy') }}
{{ Form::hidden('company', (isset($client->company) ? $client->company->id : null)) }}
{{ Form::text('comp', (isset($client->company) ? $client->company->name : null), ['id' => 'comp']) }}
  
@if (\Request::input('back_to'))
  {{ Form::hidden('back_to', \Request::input('back_to')) }}
@endif

{{ Form::submit('Zaktualizuj') }}

{{ Form::close() }}

@endsection

@section('scripts')
{{ Html::script('/js/autosuggest.js') }}
{{ Html::script('/js/jquery-ui.min.js') }}
<script>
  $(document).ready(function () {
	new bsn.AutoSuggest('comp', companies);
  });

  var companies = {
	script: function (name) {
	  return "/companies/hint/" + name;
	},
	varname: "name",
	json: true,
	delay: 250,
	timeout: 5000,
	noresults: "Brak podpowiedzi, zostanie dodana nowa firma",
	callback: function (obj) {
	  var data = JSON.parse(obj.id);
	  document.getElementsByName('company')[0].value = data['id'];
	}
  };
</script>
@endsection
