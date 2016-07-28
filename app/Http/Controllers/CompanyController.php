<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller {

  public function index() {
	$companies = \App\Company::orderBy('name')->get();
	
	return view('companies.index', ['companies' => $companies, 'success' => \Request::input('success'), 'error' => \Request::input('error')]);
  }

  public function create() {
	return view('companies.create');
  }

  public function store(Request $request) {
	$rules = [
		'nip' => 'required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/|unique',
		'name' => 'required',
		'code' => 'regex:/[0-9]{2}-[0-9]{3}/'];
	$this->validate($request, $rules);

	$company = \App\Company;
	$company->nip = $request->input('nip');
	$company->name = $request->input('name');
	$company->address = $request->input('address');
	$company->code = $request->input('code');
	if ($request->input('city') != '') {
	  $company->city()->associate(\App\City::firstOrCreate(['name' => $request->input('city')]));
	}
	$company->save();

	return redirect()->action('CompanyController@show', ['id' => $company->id, 'success' => 'Firma została dodana.']);
  }

  public function show($id) {
	$company = \App\Company::find($id);

	$previous = \App\Company::where('id', '<', $company->id)->max('id');
	$next = \App\Company::where('id', '>', $company->id)->min('id');

	return view('companies.show', ['company' => $company, 'previous' => $previous, 'next' => $next, 'success' => \Request::input('success'), 'error' => \Request::input('error')]);
  }

  public function edit($id) {
	$company = \App\Company::find($id);

	return view('companies.edit', ['company' => $company, 'back_to' => \Request::input('back_to')]);
  }

  public function update(Request $request, $id) {
	$rules = [
		'nip' => 'required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/|unique:companies,nip,'.$id,
		'name' => 'required',
		'code' => 'regex:/[0-9]{2}-[0-9]{3}/'];
	$this->validate($request, $rules);

	$company = \App\Company::find($id);
	$company->nip = $request->input('nip');
	$company->name = $request->input('name');
	$company->address = $request->input('address');
	$company->code = $request->input('code');
	if ($request->input('city') != '') {
	  $company->city()->associate(\App\City::firstOrCreate(['name' => $request->input('city')]));
	}
	$company->save();

	if ($request->input('back_to') == 'show') {
	  return redirect()->action('CompanyController@show', ['id' => $id, 'success' => 'Dane firmy zostały zaktualizowane.']);
	}
	else {
	  return redirect()->action('CompanyController@index', ['success' => 'Dane firmy zostały zaktualizowane.']);
	}
  }

  public function destroy($id) {
	$company = \App\Company::find($id);
	
	if (count($company->clients) == 0 && count($company->orders) == 0) {
	  $company->delete();

	  return redirect()->action('CompanyController@index', ['message' => 'Firma została usunięta']);
	}
	else {
	  return redirect()->action('CompanyController@index', ['error' => 'Nie można usunąć tej firmy.']);
	}
  }

  public function hint($name) {
	$companies = \App\Company::where('name', 'like', '%' . $name . '%')->take(10)->get();

	$companiesarray = array();
	foreach ($companies as $c) {
	  $clients = \App\Client::where('company_id', $c->id)->get();

	  $client_list = array();
	  foreach ($clients as $cl) {
		if ($cl->firstname == null && $cl->lastname == null) {
		  array_push($client_list, ['id' => $cl->id, 'name' => $cl->mail]);
		}
		else {
		  array_push($client_list, ['id' => $cl->id, 'name' => $cl->firstname . " " . $cl->lastname]);
		}
	  }

	  $id = ['id' => $c->id, 'nip' => $c->nip, 'address' => $c->address, 'code' => $c->code, 'city' => $c->city->name, 'clients' => $client_list];
	  array_push($companiesarray, ['id' => json_encode($id), 'value' => $c->name, 'info' => $c->nip]);
	}
	return "{ results: " . json_encode($companiesarray) . "}";
  }

}
