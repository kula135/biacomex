<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller {

  public function index() {
	$cities = \App\City::orderBy('name')->get();

	return view('cities.index', ['cities' => $cities, 'success' => \Request::input('success'), 'error' => \Request::input('error')]);
  }

  public function create() {
	return view('cities.create');
  }

  public function store(Request $request) {
	$this->validate($request, ['name' => 'required|unique:cities']);

	$city = new \App\City;
	$city->name = $request->input('name');
	$city->save();

	return redirect()->action('CityController@index', ['success' => 'Miasto zostało dodane.']);
  }

  public function edit($id) {
	$city = \App\City::find($id);

	return view('cities.edit', ['city' => $city]);
  }

  public function update(Request $request, $id) {
	$this->validate($request, ['name' => 'required|unique:cities']);

	$city = \App\City::find($id);
	$city->name = $request->input('name');
	$city->save();

	return redirect()->action('CityController@index', ['success' => 'Nazwa miasta została zaktualizowana.']);
  }

  public function destroy($id) {
	$city = \App\City::find($id);
	
	if (count($city->company) == 0 && count($city->tripfrom) == 0 && count($city->tripto) == 0) {
	  $city->delete();
	  return redirect()->action('CityController@index', ['success' => 'Miasto zostało usunięte.']);
	}
	else {
	  return redirect()->action('CityController@index', ['error' => 'Nie można usunąć tego miasta.']);
	}
  }

  public function hint($name) {
	$cities = \App\City::where('name', 'like', '%' . $name . '%')->select("name")->take(10)->get();

	$cityarray = array();
	foreach ($cities as $c) {
	  array_push($cityarray, ['id' => $c->name, 'value' => $c->name, 'info' => '']);
	}

	return "{ results: " . json_encode($cityarray) . "}";
  }

}
