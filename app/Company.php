<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

  protected $table = 'companies';
  protected $fillable = ['nip'];

  public function city() {
	return $this->belongsTo('App\City');
  }

  public function clients() {
	return $this->hasMany('App\Client');
  }
  
  public function orders() {
	return $this->hasMany('App\Order');
  }
}
