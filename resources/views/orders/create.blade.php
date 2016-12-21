@extends('layout.master')

@section('title', ' - nowe zamówienie')

@section('styles')
{{ Html::style('/css/jquery-ui.min.css') }}
{{ Html::style('/css/modify.css') }}
@endsection

@section('content')
<h1>Nowe zamówienie</h1>
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

{{ Form::open(array('url' => 'orders')) }}
{{ Form::token() }}

<fieldset>
  <legend>Zamawiający</legend>
  <table>
    <tr>
      <td>
        {{ Form::radio('private', '0', true, ['id' => 'privateno', 'onclick' => "$('#company').show(1000); document.getElementsByName('nip')[0].required = true; document.getElementsByName('name')[0].required = true"]) }}
        {{ Form::label('privateno', 'Firma', ['class' => 'inline']) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::radio('private', '1', false, ['id' => 'privateyes', 'onclick' => "$('#company').hide(1000); document.getElementsByName('nip')[0].required = false; document.getElementsByName('name')[0].required = false"]) }}
        {{ Form::label('privateyes', 'Osoba prywatna', ['class' => 'inline']) }}
      </td>
    </tr>
  </table>
  <div id="company">
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
          {{ Form::text('city') }}
        </td>
      </tr>
    </table>
    <h4>Osoba kontaktowa</h4>
	<div id="client_select"></div>
  </div>
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
<fieldset>
  <legend>Trasa</legend>
  <table>
    <tr>
      <td>
        {{ Form::label('tripfrom', 'Z', ['class' => 'required']) }}
        {{ Form::text('tripfrom', null, ['required' => true]) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::label('tripto', 'Do', ['class' => 'required']) }}
        {{ Form::text('tripto', null, ['required' => true]) }}
      </td>
    </tr>
  </table>
  {{ Form::label('via', 'Przez') }}
  {{ Form::button('Dodaj przez', ['id'=>'via', 'onclick' => 'addVia()']) }}

  {{ Form::label('distance', 'Dystans', ['class' => 'required']) }}
  {{ Form::text('distance', null, ['required' => true]) }}

  {{ Form::label('tripinfo', 'Dodatkowe informacje') }}
  {{ Form::textarea('tripinfo') }}
</fieldset>
<fieldset>
  <legend>Data wyjazdu</legend>
  <table>
    <tr>
      <td>
        {{ Form::label('datefrom', 'Od', ['class' => 'required']) }}
        {{ Form::text('datefrom', null, ['id' => 'datefrom', 'placeholder' => 'dd/mm/rrrr', 'required' => true]) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::label('dateto', 'Do', ['class' => 'required']) }}
        {{ Form::text('dateto', null, ['id' => 'dateto', 'placeholder' => 'dd/mm/rrrr', 'required' => true]) }}
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
  {{ Form::text('price', null, ['required' => true]) }}

  {{ Form::label('priceinfo', 'Szczegóły') }}
  {{ Form::textarea('priceinfo') }}
</fieldset>
<fieldset>
  <legend>Zlecenie</legend>
  <table>
    <tr>
      <td>
        {{ Form::label('requestdate', 'Data otrzymania', ['class' => 'required']) }}
        {{ Form::text('requestdate', null, ['id' => 'requestdate', 'placeholder' => 'dd/mm/rrrr', 'required' => true]) }}
      </td>
      <td width="1%"></td>
      <td>
        {{ Form::label('answerdate', 'Data odpowiedzi', ['class' => 'required']) }}
        {{ Form::text('answerdate', null, ['id' => 'answerdate', 'placeholder' => 'dd/mm/rrrr', 'required' => true]) }}
      </td>
    </tr>
  </table>
</fieldset>

{{ Form::submit('Zapisz') }}

{{ Form::close() }}

@endsection

@section('scripts')
{{ Html::script('/js/autosuggest.js') }}
{{ Html::script('/js/jquery-ui.min.js') }}
<script>
  $(document).ready(function () {
	if (document.getElementById('privateyes').checked === true) {
	  $('#company').hide(0);
	  document.getElementsByName('nip')[0].required = false;
	  document.getElementsByName('name')[0].required = false;
	}

	findCity('city');
	findCity('tripfrom');
	findCity('tripto');
	addVia();

	new bsn.AutoSuggest('name', companies);
	new bsn.AutoSuggest('mail', clients);

	$("#datefrom").datepicker({
	  dateFormat: "dd/mm/yy",
	  changeMonth: true,
	  changeYear: true,
	  dayNamesMin: ["N", "Pn", "Wt", "Śr", "Cz", "Pt", "So"],
	  monthNamesShort: ["Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"],
	  onSelect: function (selected) {
		$('#dateto').datepicker("option", "minDate", selected);
		if ($('#dateto').val() === '') {
		  $('#dateto').val(selected);
		}
	  }
	});

	$("#dateto").datepicker({
	  dateFormat: "dd/mm/yy",
	  changeMonth: true,
	  changeYear: true,
	  dayNamesMin: ["N", "Pn", "Wt", "Śr", "Cz", "Pt", "So"],
	  monthNamesShort: ["Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"],
	  onSelect: function (selected) {
		$('#datefrom').datepicker("option", "maxDate", selected);
		if ($('#datefrom').val() === '') {
		  $('#datefrom').val(selected);
		}
	  }
	});

	$("#requestdate").datepicker({
	  dateFormat: "dd/mm/yy",
	  changeMonth: true,
	  changeYear: true,
	  dayNamesMin: ["N", "Pn", "Wt", "Śr", "Cz", "Pt", "So"],
	  monthNamesShort: ["Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"],
	  onSelect: function (selected) {
		$('#answerdate').datepicker("option", "minDate", selected);
		if ($('#answerdate').val() === '') {
		  $('#answerdate').val(selected);
		}
	  }
	});

	$("#answerdate").datepicker({
	  dateFormat: "dd/mm/yy",
	  changeMonth: true,
	  changeYear: true,
	  dayNamesMin: ["N", "Pn", "Wt", "Śr", "Cz", "Pt", "So"],
	  monthNamesShort: ["Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"],
	  onSelect: function (selected) {
		$('#requestdate').datepicker("option", "maxDate", selected);
		if ($('#requestdate').val() === '') {
		  $('#requestdate').val(selected);
		}
	  }
	});
  });
  
  var via = 0;
  function addVia() {
	via++;
	var newInput = document.createElement("input");
	newInput.setAttribute("type", "text");
	newInput.setAttribute("id", "via_"+via);
	newInput.setAttribute("name", "via_"+via);
	newInput.setAttribute("placeholder", "Miejscowość "+via);
	
	$("#via").before($(newInput).fadeIn(500));
	findCity('via_'+via);
  }

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

  function load_client(el) {
	console.log(el);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
	  if (xhttp.readyState == 4 && xhttp.status == 200 && xhttp.responseText != '') {
		var data = JSON.parse(xhttp.responseText);
		document.getElementsByName('firstname')[0].value = data['firstname'];
		document.getElementsByName('lastname')[0].value = data['lastname'];
		document.getElementsByName('mail')[0].value = data['mail'];
		document.getElementsByName('phone')[0].value = data['phone'];
	  }
	};
	xhttp.open("GET", "/clients/hint/id/" + el.value, true);
	xhttp.send();
  }

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
	  document.getElementsByName('nip')[0].value = data['nip'];
	  document.getElementsByName('address')[0].value = data['address'];
	  document.getElementsByName('code')[0].value = data['code'];
	  document.getElementsByName('city')[0].value = data['city'];

	  var str = '<option value="" disabled selected>Wybierz ...</option>';
	  if (data['clients'].length > 0) {
		for (c in data['clients']) {
		  str += "<option value='" + data['clients'][c]['id'] + "'>" + data['clients'][c]['name'] + "</option>";
		}
	  }

	  document.getElementById('client_select').innerHTML = "<label>Wybierz pracownika firmy z listy lub uzupełnij dane poniżej</label><select onchange='load_client(this)'>" + str + "</select>";
	}
  };

  var clients = {
	script: function (mail) {
	  return "/clients/hint/" + mail;
	},
	varname: "mail",
	json: true,
	delay: 250,
	timeout: 5000,
	noresults: "Brak podpowiedzi, zostanie dodany nowy klient",
	callback: function (obj) {
	  var data = JSON.parse(obj.id);
	  document.getElementsByName('firstname')[0].value = data['firstname'];
	  document.getElementsByName('lastname')[0].value = data['lastname'];
	  document.getElementsByName('phone')[0].value = data['phone'];
	}
  };
</script>
@endsection
