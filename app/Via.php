<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Via extends Model {

  protected $fillable = ['position'];
  
  public function city() {
	return $this->belongsTo('App\City');
  }

  public function order() {
    return $this->belongsTo('App\Order');
  }
}
