@extends('layout.master')

@section('title', 'wszystkie zamówienia')

@section('style')
<script>

  function ConfirmDelete()
  {
  var x = confirm("Czy na pewno chcesz usunąć to zlecenie?");
  if (x)
    return true;
  else
    return false;
  }

</script>
@endsection

@section('content')
<h1>Lista zleceń</h1>
@if (isset($message))
  <div class="alert alert-success">
    {{ $message }}
  </div>
@endif
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th rowspan="2">L.p.</th>
      <th colspan="2">Trasa</th>
      <th colspan="2">Czas</th>
      <th rowspan="2"></th>
    </tr>
    <tr>
      <td>Z</td>
      <td>Do</td>
      <td>Od</td>
      <td>Do</td>
    </tr>
  </thead>
  <tbody>
    @if(count($orders) == 0)
    <tr><td colspan="6">Brak zleceń</td></tr>
    @else
      <?php $a=1; ?>
      @foreach($orders as $key => $value)
      <tr>
        <td>{{ $a++ }}.</td>
        <td>{{ $value->tripfrom }}</td>
        <td>{{ $value->tripto }}</td>
        <td>{{ $value->datefrom }}</td>
        <td>{{ $value->dateto }}</td>
        <td style="width: 212px;">
          <a class="btn btn-small btn-success" href="{{ URL::to('orders/' . $value->id) }}">Pokaż</a>
          <a class="btn btn-small btn-warning" href="{{ URL::to('orders/' . $value->id . '/edit') }}">Edytuj</a>
          {{ Form::open(array('url' => 'orders/' . $value->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
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