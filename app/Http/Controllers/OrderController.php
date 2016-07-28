<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller {

  public function index() {
    $orders = \App\Order::all();
    return view('orders.index', ['orders' => $orders, 'message' => \Request::input('message')]);
  }

  public function create() {
    return view('orders.create');
  }

  public function store(Request $request) {
    $this->validate_order($request);

    if ($request->input('private') == 0) { // firma
      $company = $this->update_company($request);
      $client = $this->update_client($request, $company);
    }
    else {
      $company = null;
      $client = $this->update_client($request);
    }

    $order = new \App\Order;
    $order->company()->associate($company);
    $order->client()->associate($client);
    $order->tripfrom()->associate(\App\City::firstOrCreate(['name' => $request->input('tripfrom')]));
    $order->tripto()->associate(\App\City::firstOrCreate(['name' => $request->input('tripto')]));
    $order->tripinfo = $request->input('tripinfo');
    $order->distance = $request->input('distance');
    $order->datefrom = $request->input('datefrom');
    $order->dateto = $request->input('dateto');
    $order->description = $request->input('description');
    $order->count = $request->input('count');
    $order->vehicle = $request->input('vehicle');
    $order->price = $request->input('price');
    $order->priceinfo = $request->input('priceinfo');
    $order->requestdate = $request->input('requestdate');
    $order->answerdate = $request->input('answerdate');
    $order->save();

    return redirect()->action('OrderController@index', ['message' => 'Zlecenie zostało dodane']);
  }

  public function show($id) {
    $order = \App\Order::find($id);

    $previous = \App\Order::where('id', '<', $order->id)->max('id');
    $next = \App\Order::where('id', '>', $order->id)->min('id');

    return view('orders.show', ['order' => $order, 'previous' => $previous, 'next' => $next]);
  }

  public function edit($id) {
    $order = \App\Order::find($id);
    return view('orders.edit', ['order' => $order]);
  }

  public function update(Request $request, $id) {
    $this->validate_order($request);

    if ($request->input('private') == 0) { // firma
      $company = $this->update_company($request);
      $client = $this->update_client($request, $company);
    }
    else {
      $company = null;
      $client = $this->update_client($request);
    }

    $order = \App\Order::find($id);
    $order->company()->associate($company);
    $order->client()->associate($client);
    $order->tripfrom()->associate(\App\City::firstOrCreate(['name' => $request->input('tripfrom')]));
    $order->tripto()->associate(\App\City::firstOrCreate(['name' => $request->input('tripto')]));
    $order->tripinfo = $request->input('tripinfo');
    $order->distance = $request->input('distance');
    $order->datefrom = $request->input('datefrom');
    $order->dateto = $request->input('dateto');
    $order->description = $request->input('description');
    $order->count = $request->input('count');
    $order->vehicle = $request->input('vehicle');
    $order->price = $request->input('price');
    $order->priceinfo = $request->input('priceinfo');
    $order->requestdate = $request->input('requestdate');
    $order->answerdate = $request->input('answerdate');
    $order->save();

    return redirect()->action('OrderController@index', ['message' => 'Zlecenie zostało zaktualizowane']);
  }

  public function destroy($id) {
    $order = \App\Order::find($id);
    $order->delete();

    return redirect()->action('OrderController@index', ['message' => 'Zlecenie zostało usunięte']);
  }

  private function validate_order($request) {
	$rules = [
                'mail' => 'required|email',
                'tripfrom' => 'required',
                'tripto' => 'required',
                'distance' => 'required',
                'datefrom' => 'required|date_format:d/m/Y',
                'dateto' => 'required|date_format:d/m/Y',
                'price' => 'required',
                'requestdate' => 'date_format:d/m/Y',
                'answerdate' => 'date_format:d/m/Y'
    ];
	
	if ($request->input('private') == 0) {
	  $rules['nip'] = 'required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/';
	  $rules['name'] = 'required';
	  $rules['code'] = 'regex:/[0-9]{2}-[0-9]{3}/';
	}
	
    return $this->validate($request, $rules);
  }

  private function update_company($request) {
    $modified = false;

    $company = \App\Company::firstOrNew(['nip' => str_replace('-', '', $request->input('nip'))]);

    if ($company->name != $request->input('name')) {
      $company->name = $request->input('name');
      $modified = true;
    }

    if ($company->address != $request->input('address')) {
      $company->address = $request->input('address');
      $modified = true;
    }

    if ($company->code != str_replace('-', '', $request->input('code'))) {
      $company->code = $request->input('code');
      $modified = true;
    }

    if (isset($company->city) && $request->input('city') == NULL) {
      $company->city()->dissociate();
      $modified = true;
    }
    elseif ($request->input('city') != NULL && (!isset($company->city) || $company->city->name != ucwords($request->input('city')))) {
      $company->city()->associate(\App\City::firstOrCreate(['name' => $request->input('city')]));
      $modified = true;
    }

    if ($modified) {
      $company->save();
    }

    return $company;
  }

  private function update_client($request, $company = null) {
    $modified = false;

    $client = \App\Client::firstOrNew(['mail' => $request->input('mail')]);

    if ($client->firstname != $request->input('firstname')) {
      $client->firstname = $request->input('firstname');
      $modified = true;
    }

    if ($client->lastname != $request->input('lastname')) {
      $client->lastname = $request->input('lastname');
      $modified = true;
    }

    if ($client->phone != $request->input('phone')) {
      $client->phone = $request->input('phone');
      $modified = true;
    }

    if (isset($client->company) && $company == NULL) {
      $client->company()->dissociate();
      $modified = true;
    }
    elseif (!isset($client->company) || $client->company->name != $company) {
      $client->company()->associate($company);
      $modified = true;
    }

    if ($modified) {
      $client->save();
    }

    return $client;
  }

}
