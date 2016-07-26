<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  public function company() {
    return $this->belongsTo('App\Company');
  }

  public function client() {
    return $this->belongsTo('App\Client');
  }

  public function tripfrom() {
    return $this->belongsTo('App\City');
  }

  public function tripto() {
    return $this->belongsTo('App\City');
  }

  public function setDateFromAttribute($value) {
    $this->attributes['datefrom'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setDateToAttribute($value) {
    $this->attributes['dateto'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setRequestDateAttribute($value) {
    $this->attributes['requestdate'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setAnswerDateAttribute($value) {
    $this->attributes['answerdate'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function getDateFromAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getDateToAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getRequestDateAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getAnswerDateAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

}
