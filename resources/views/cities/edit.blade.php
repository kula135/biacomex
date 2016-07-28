@extends('layout.master')

@section('title', ' - miasta')

@section('styles')
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Zmień nazwę miasta</h1>
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

{{ Form::model($city, array('route' => array('cities.update', $city->id), 'method' => 'PUT')) }}
{{ Form::token() }}

{{ Form::label('name', 'Nazwa miasta') }}
{{ Form::text('name', null, ['required' => true]) }}

{{ Form::submit('Zaktualizuj') }}

{{ Form::close() }}

@endsection