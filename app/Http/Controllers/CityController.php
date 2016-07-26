<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $cities = \App\City::orderBy('name')->get();
    return view('cities.index', ['cities' => $cities, 'message' => \Request::input('message')]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $city = \App\City::find($id);
    return view('cities.edit', ['city' => $city]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $this->validate($request, ['name' => 'required|unique']);

    $city = \App\City::find($id);
    $city->name = $request->input('name');
    $city->save();

    return redirect()->action('CityController@index', ['message' => 'Nazwa miasta została zaktualizowana']);
  }

  /**
   * Getting city hints.
   *
   * @param  $name nazwa miasta
   * @return json { results: [{"id":"id","value":"value","info":""},...]} where both id, value are city name
   */
  public function hint($name) {
    $city = \App\City::where('name', 'like', '%'.$name.'%')->select("name")->take(10)->get();
    $cityarray = array();
	foreach ($city as $c) {
	  array_push($cityarray, ['id' => $c->name, 'value' => $c->name, 'info' => '']);
	}
	echo "{ results: ".json_encode($cityarray)."}";
  }

}
