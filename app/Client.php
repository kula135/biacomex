<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

  protected $fillable = ['mail'];
  
  public function company() {
    return $this->belongsTo('App\Company', 'company_id');
  }

  public function setFirstNameAttribute($value) {
    $this->attributes['firstname'] = ucwords($value);
  }

  public function setLastNameAttribute($value) {
    $this->attributes['lastname'] = ucwords($value);
  }

}
