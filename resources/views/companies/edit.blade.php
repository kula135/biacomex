@extends('layout.master')

@section('title', ' - firma')

@section('styles')
{{ Html::style('/css/jquery-ui.min.css') }}
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Firma {{$company->name}}</h1>
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

<fieldset>
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
		{{ Form::text('city', isset($company->city) ? $company->city->name : '') }}
	  </td>
	</tr>
  </table>
  <h4>Osoba kontaktowa</h4>
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
</fieldset>

{{ Form::submit('Zaktualizuj') }}

{{ Form::close() }}

@endsection

@section('scripts')
{{ Html::script('/js/autosuggest.js') }}
{{ Html::script('/js/jquery-ui.min.js') }}

<script>
  $(document).ready(function () {
	findCity('city');
  });

  function findCity(name) {
	var options = {
	  script: function (name) {
		return "/cities/hint/" + name;
	  },
	  varname: "name",
	  json: true,
	  delay: 250,
	  timeout: 5000,
	  noresults: "Brak podpowiedzi, zostanie dodana nowa miejscowość"
	};
	new bsn.AutoSuggest(name, options);
  }
</script>
@endsection
