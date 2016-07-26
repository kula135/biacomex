<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ClientController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
	//
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
	//
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
	//
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
	//
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
	//
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
	//
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
	//
  }

  /**
   * Getting clients hints.
   *
   * @param  $mail adres email
   * @return json { results: [{"id":"id","value":"value","info":"info"},...]}
   * 	where
   * 	  id - json firstname, lastname, phone,
   * 	  value - email,
   * 	  info - firstname, lastname
   */
  public function hint($mail) {
	$clients = \App\Client::where('mail', 'like', '%' . $mail . '%')->where('company_id', null)->take(10)->get();
	$clientsarray = array();
	foreach ($clients as $c) {
	  $id = ['firstname' => $c->firstname, 'lastname' => $c->lastname, 'phone' => $c->phone];
	  array_push($clientsarray, ['id' => json_encode($id), 'value' => $c->mail, 'info' => $c->firstname . ' ' . $c->lastname]);
	}
	echo "{ results: " . json_encode($clientsarray) . "}";
  }
  
  /**
   * Getting clients hints.
   *
   * @param  $mail adres email
   * @return json { results: [{"id":"id","value":"value","info":"info"},...]}
   * 	where
   * 	  id - json firstname, lastname, phone,
   * 	  value - email,
   * 	  info - firstname, lastname
   */
  public function hint_by_id($id) {
	$client = \App\Client::find($id);
	echo $client ? $client->toJSON() : null;
  }

}
