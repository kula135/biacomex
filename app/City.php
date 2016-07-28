<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

  protected $table = 'cities';
  protected $fillable = ['name'];

  public function setNameAttribute($value) {
    $this->attributes['name'] = ucwords($value);
  }
  
  /* ========= RELACJE ======================= */
  public function company() {
	return $this->hasMany('App\Company', 'city_id');
  }

  public function tripfrom() {
	return $this->hasMany('App\Order', 'tripfrom_id');
  }

  public function tripto() {
	return $this->hasMany('App\Order', 'tripto_id');
  }

}
