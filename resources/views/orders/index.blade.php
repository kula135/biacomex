@extends('layout.master')

@section('title', 'wszystkie zlecenia')

@section('content')
<h1>Lista zleceń</h1>
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
  <tbody><?php var_dump($orders);?>
    @if(!$orders)
    <tr><td colspan="5">Brak zleceń</td></tr>
    @else
      <?php $a=1; ?>
      @foreach($orders as $key => $value)
      <tr>
        <td>{{ $a++ }}</td>
        <td>{{ $value->tripfrom }}</td>
        <td>{{ $value->tripto }}</td>
        <td>{{ $value->datefrom }}</td>
        <td>{{ $value->dateto }}</td>

        <!-- we will also add show, edit, and delete buttons -->
        <td>

          <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
          <!-- we will add this later since its a little more complicated than the other two buttons -->

          <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
          <a class="btn btn-small btn-success" href="{{ URL::to('order/' . $value->id) }}">Show</a>

          <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
          <a class="btn btn-small btn-info" href="{{ URL::to('order/' . $value->id . '/edit') }}">Edit</a>

        </td>
      </tr>
      @endforeach
    @endif
  </tbody>
</table>

@endsection