@extends('layout.master')

@section('title', 'nowe zlecenie')

@section('content')
<h1>Nowe zleceń</h1>
<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'orders')) }}

<div class="form-group">
  {{ Form::label('name', 'Name') }}
  {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
  {{ Form::label('email', 'Email') }}
  {{ Form::email('email', old('email'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
  {{ Form::label('nerd_level', 'Nerd Level') }}
  {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), old('nerd_level'), array('class' => 'form-control')) }}
</div>

{{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection