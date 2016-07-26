<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	/**
   * Getting companies hints.
   *
   * @param  $nip NIP
   * @return json { results: [{"id":"id","value":"value","info":"info"},...]}
   * 	where
   * 	  id - json firstname, lastname, phone,
   * 	  value - email,
   * 	  info - firstname, lastname
   */
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
		  array_push($client_list, ['id' => $cl->id, 'name' => $cl->firstname." ".$cl->lastname]);
		}
	  }
	  $id = ['nip' => $c->nip, 'address' => $c->address, 'code' => $c->code, 'city' => $c->city->name, 'clients' => $client_list];
	  array_push($companiesarray, ['id' => json_encode($id), 'value' => $c->name, 'info' => $c->nip]);
	}
	echo "{ results: " . json_encode($companiesarray) . "}";
  }

}
