@extends('layout.master')

@section('title', 'edycja zamówienia')

@section('style')
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Edycja zamówienia nr {{ $order->id }}</h1>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

{{ Form::model($order, array('route' => array('orders.update', $order->id), 'method' => 'PUT')) }}
{{ Form::token() }}

<fieldset>
  <legend>Zamawiający</legend>
  <table>
    <tr>
      <td>
        {{ Form::radio('private', 'no', true, array('id' => 'privateno', 'onclick' => "document.getElementById('company').style = 'display: block'")) }}
        {{ Form::label('privateno', 'Firma', array('class' => 'inline')) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::radio('private', 'yes', false, array('id' => 'privateno', 'onclick' => "document.getElementById('company').style = 'display: block'")) }}
        {{ Form::label('privateyes', 'Osoba prywatna', array('class' => 'inline')) }}
      </td>
    </tr>
  </table>
  <div id="company">
    {{ Form::label('nip', 'NIP') }}
    {{ Form::text('nip') }}

    {{ Form::label('name', 'Nazwa firmy') }}
    {{ Form::text('name') }}

    {{ Form::label('address', 'Adres') }}
    {{ Form::text('address') }}

    <table>
      <tr>
        <td width="30%">
          {{ Form::label('code', 'Kod pocztowy') }}
          {{ Form::text('code') }}
        </td>
        <td width="1%"></td>
        <td>
          {{ Form::label('city', 'Miejscowość') }}
          {{ Form::text('city') }}
        </td>
      </tr>
    </table>
    <h4>Osoba kontaktowa</h4>
  </div>
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
  {{ Form::label('mail', 'Adres e-mail', ['class' => 'required']) }}
  {{ Form::email('mail', null, array('required' => true)) }}


  {{ Form::label('phone', 'Telefon') }}
  {{ Form::tel('phone') }}
</fieldset>
<fieldset>
  <legend>Trasa</legend>
  <table>
    <tr>
      <td>
        {{ Form::label('tripfrom', 'Z', ['class' => 'required']) }}
        {{ Form::text('tripfrom', null, array('required' => true)) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::label('tripto', 'Do', ['class' => 'required']) }}
        {{ Form::text('tripto', null, array('required' => true)) }}
      </td>
    </tr>
  </table>
  {{ Form::label('distance', 'Dystans', ['class' => 'required']) }}
  {{ Form::text('distance', null, array('required' => true)) }}

  {{ Form::label('tripinfo', 'Dodatkowe informacje') }}
  {{ Form::textarea('tripinfo') }}
</fieldset>
<fieldset>
  <legend>Data wyjazdu</legend>
  <table>
    <tr>
      <td>
        {{ Form::label('datefrom', 'Od', ['class' => 'required']) }}
        {{ Form::text('datefrom', null, array('required' => true)) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::label('dateto', 'Do', ['class' => 'required']) }}
        {{ Form::text('dateto', null, array('required' => true)) }}
      </td>
    </tr>
  </table>
</fieldset>
<fieldset>
  <legend>Szczegóły</legend>
  {{ Form::textarea('description') }}
</fieldset>
<fieldset>
  <legend>Ilość osób</legend>
  {{ Form::text('count') }}
</fieldset>
<fieldset>
  <legend>Środek transportu</legend>
  {{ Form::text('vehicle') }}
</fieldset>
<fieldset>
  <legend>Cena</legend>
  {{ Form::label('price', 'Całkowita', ['class' => 'required']) }}
  {{ Form::text('price', null, array('required' => true)) }}

  {{ Form::label('priceinfo', 'Szczegóły') }}
  {{ Form::textarea('priceinfo') }}
</fieldset>
<fieldset>
  <legend>Zlecenie</legend>
  <table>
    <tr>
      <td>
        {{ Form::label('requestdate', 'Data otrzymania', ['class' => 'required']) }}
        {{ Form::text('requestdate', null, array('required' => true)) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::label('answerdate', 'Data odpowiedzi', ['class' => 'required']) }}
        {{ Form::text('answerdate', null, array('required' => true)) }}
      </td>
    </tr>
  </table>
</fieldset>

{{ Form::submit('Zaktualizuj') }}

{{ Form::close() }}

@endsection