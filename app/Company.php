<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

  protected $table = 'companies';
  protected $fillable = ['nip'];

  public function city() {
    return $this->belongsTo('App\City');
  }
  
  public function setNipAttribute($value) {
    $this->attributes['nip'] = str_replace('-', '', $value);
  }
  
  public function getNipAttribute($value) {
    return ($value==null ? '' : substr($value, 0, 3) . '-' . substr($value, 3, 3) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 2));
  }

  public function setCodeAttribute($value) {
    $this->attributes['code'] = str_replace('-', '', $value);
  }
  
  public function getCodeAttribute($value) {
    return ($value==null ? '' : substr($value, 0, 2) . '-' . substr($value, 2));
  }
  
  public function clients() {
    return $this->hasMany('App\Client');
  }

}
