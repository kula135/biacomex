@extends('layout.master')

@section('title', ' - nowy klient')

@section('styles')
{{ Html::style('/css/jquery-ui.min.css') }}
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Nowy klient</h1>
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

{{ Form::open(array('url' => 'clients')) }}
{{ Form::token() }}

<fieldset>
  
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

{{ Form::submit('Zapisz') }}

{{ Form::close() }}

@endsection
