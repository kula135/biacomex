<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller {

  public function index() {
	$clients = \App\Client::orderBy('lastname')->orderBy('firstname')->get();

	return view('clients.index', ['clients' => $clients, 'success' => \Request::input('success'), 'error' => \Request::input('error')]);
  }

  public function create() {
	return view('clients.create', ['company' => \Request::input('company'), 'company_id' => \Request::input('company_id')]);
  }

  public function store(Request $request) {
	$this->validate($request, ['mail' => 'required|unique:clients']);

	$client = new \App\Client;
	$client->firstname = $request->input('firstname');
	$client->lastname = $request->input('lastname');
	$client->mail = $request->input('mail');
	$client->phone = $request->input('phone');
	if ($request->input('company')) {
	  $client->company()->associate(\App\Company::find($request->input('company')));
	}
	$client->save();
	
	if ($request->input('company')) {
	  return redirect()->action('CompanyController@show', ['id' => $request->input('company'), 'success' => 'Klient został dodany.']);
	}
	else {
	  return redirect()->action('ClientController@index', ['success' => 'Klient został dodany.']);
	}
  }

  public function show($id) {
	$client = \App\Client::find($id);

    $previous = \App\Client::where('id', '<', $client->id)->max('id');
    $next = \App\Client::where('id', '>', $client->id)->min('id');

    return view('clients.show', ['client' => $client, 'previous' => $previous, 'next' => $next]);
  }

  public function edit($id) {
	$client = \App\Client::find($id);
	
    return view('clients.edit', ['client' => $client, 'back_to' => \Request::input('back_to')]);
  }

  public function update(Request $request, $id) {
	$this->validate($request, ['mail' => 'required|unique:clients,mail,'.$id]);

	$client = \App\Client::find($id);
	$client->firstname = $request->input('firstname');
	$client->lastname = $request->input('lastname');
	$client->mail = $request->input('mail');
	$client->phone = $request->input('phone');
	if ($request->input('company')) {
	  $client->company()->associate(\App\Company::find($request->input('company')));
	}
	elseif (isset($client->company)) {
	  $client->company()->dissociate();
	}
	$client->save();
	
	if ($request->input('back_to') == 'company') {
	  return redirect()->action('CompanyController@show', ['id' => $client->company->id, 'success' => 'Dane o kliencie zostały zaktualizowane.']);
	}
	elseif ($request->input('back_to') == 'show') {
	  return redirect()->action('ClientController@show', ['id' => $id, 'success' => 'Dane o kliencie zostały zaktualizowane.']);
	}
	else {
	  return redirect()->action('ClientController@index', ['success' => 'Dane o kliencie zostały zaktualizowane.']);
	}
  }

  public function destroy($id) {
	$client = \App\Client::find($id);
	
	if (count($client->orders) == 0) {
	  $client->delete();
	  
	  if (\Request::input('company')) {
		return redirect()->action('CompanyController@show', ['id' => \Request::input('company'), 'success' => 'Klient został usunięty.']);
	  }
	  else {
		return redirect()->action('ClientController@index', ['success' => 'Klient został usunięty.']);
	  }
	}
	else {
	  if (\Request::input('company')) {
		return redirect()->action('CompanyController@show', ['id' => \Request::input('company'), 'error' => 'Nie można usunąć tego klienta.']);
	  }
	  else {
		return redirect()->action('ClientController@index', ['error' => 'Nie można usunąć tego klienta.']);
	  }
	}
  }

  public function hint($mail) {
	$clients = \App\Client::where('mail', 'like', '%' . $mail . '%')->where('company_id', null)->take(10)->get();
	
	$clientsarray = array();
	foreach ($clients as $c) {
	  $id = ['firstname' => $c->firstname, 'lastname' => $c->lastname, 'phone' => $c->phone];
	  array_push($clientsarray, ['id' => json_encode($id), 'value' => $c->mail, 'info' => $c->firstname . ' ' . $c->lastname]);
	}
	echo "{ results: " . json_encode($clientsarray) . "}";
  }
  
  public function hint_by_id($id) {
	$client = \App\Client::find($id);
	echo $client ? $client->toJSON() : null;
  }

}
