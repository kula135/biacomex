@extends('layout.master')

@section('scripts_and_styles')
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Nowe miasto</h1>
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

{{ Form::open(array('url' => 'cities')) }}
{{ Form::token() }}

{{ Form::label('name', 'Nazwa miasta') }}
{{ Form::text('name', null, ['required' => true]) }}

{{ Form::submit('Zapisz') }}

{{ Form::close() }}

@endsection