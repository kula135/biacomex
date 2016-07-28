<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

  protected $fillable = ['mail'];
  
  public function setFirstNameAttribute($value) {
    $this->attributes['firstname'] = ucwords($value);
  }

  public function setLastNameAttribute($value) {
    $this->attributes['lastname'] = ucwords($value);
  }

  public function orders() {
	return $this->hasMany('App\Order', 'client_id');
  }
  
  public function company() {
    return $this->belongsTo('App\Company', 'company_id');
  }

}
