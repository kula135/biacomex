<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class OrderController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $orders = \App\Order::all();
    return view('orders.index', ['orders' => $orders, 'message' => \Request::input('message')]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('orders.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $this->validate_order($request);
    
    $order = new \App\Order;
//      $order->companies = $request->input('');
//      $order->clients = $request->input('');
    $order->tripfrom_id = "1"; //$request->input('');
    $order->tripto_id = "1"; //$request->input('');
    $order->tripinfo = $request->input('tripinfo');
    $order->distance = $request->input('distance');
    $order->datefrom = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('datefrom'))));
    $order->dateto = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('dateto'))));
    $order->description = $request->input('description');
    $order->count = $request->input('count');
    $order->vehicle = $request->input('vehicle');
    $order->price = $request->input('price');
    $order->priceinfo = $request->input('priceinfo');
    $order->requestdate = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('requestdate'))));
    $order->answerdate = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('answerdate'))));
    $order->save();
    
    return redirect()->action('OrderController@index', ['message' => 'Zlecenie zostało dodane']);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $order = \App\Order::find($id);
    
    $previous = \App\Order::where('id', '<', $order->id)->max('id');
    $next = \App\Order::where('id', '>', $order->id)->min('id');
    
    return view('orders.show', ['order' => $order, 'previous' => $previous, 'next' => $next]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $order = \App\Order::find($id);
    
    return view('orders.edit', ['order' => $order]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $this->validate_order($request);
    
    $order = \App\Order::find($id);
//      $order->companies = $request->input('');
//      $order->clients = $request->input('');
    $order->tripfrom_id = "1"; //$request->input('');
    $order->tripto_id = "1"; //$request->input('');
    $order->tripinfo = $request->input('tripinfo');
    $order->distance = $request->input('distance');
    $order->datefrom = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('datefrom'))));
    $order->dateto = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('dateto'))));
    $order->description = $request->input('description');
    $order->count = $request->input('count');
    $order->vehicle = $request->input('vehicle');
    $order->price = $request->input('price');
    $order->priceinfo = $request->input('priceinfo');
    $order->requestdate = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('requestdate'))));
    $order->answerdate = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('answerdate'))));
    $order->save();
    
    return redirect()->action('OrderController@index', ['message' => 'Zlecenie zostało zaktualizowane']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $order = \App\Order::find($id);
    $order->delete();
    
    return redirect()->action('OrderController@index', ['message' => 'Zlecenie zostało usunięte']);
  }
  
  /**
   * Validate order.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  private function validate_order($request) {
    return $this->validate($request, [
      'mail' => 'required|email',
      'tripfrom' => 'required',
      'tripto' => 'required',
      'distance' => 'required',
      'datefrom' => 'required|date_format:d-m-Y',
      'dateto' => 'required|date_format:d-m-Y',
      'price' => 'required',
      'requestdate' => 'required|date_format:d-m-Y',
      'answerdate' => 'required|date_format:d-m-Y' //|after:requestdate'
    ]);
  }
}
