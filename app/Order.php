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
  
  public function vias() {
    return $this->hasMany('App\Via');
  }

  public function setDateFromAttribute($value) {
    $this->attributes['datefrom'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setDateToAttribute($value) {
    $this->attributes['dateto'] = implode("-", array_reverse(explode("/", $value)));
  }
  
  public function setDateBackFromAttribute($value) {
    $this->attributes['datebackfrom'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setDateBackToAttribute($value) {
    $this->attributes['datebackto'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setRequestDateAttribute($value) {
    $this->attributes['requestdate'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function setAnswerDateAttribute($value) {
    $this->attributes['answerdate'] = implode("-", array_reverse(explode("/", $value)));
  }

  public function getVia() {
	$list = array();
	foreach ($this->vias->sortBy('position') as $v) {
	  array_push($list, $v->city->name);
	}
	return implode(' &#10142; ', $list);
  }
  
  public function editVia() {
	$list = array();
	foreach ($this->vias->sortBy('position') as $v) {
	  array_push($list, $v->city->name);
	}
	return "['".implode("','", $list)."']";
  }
  
  public function getDateFromAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getDateToAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }
  
  public function getDateBackFromAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getDateBackToAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getRequestDateAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

  public function getAnswerDateAttribute($value) {
    return date('d/m/Y', strtotime($value));
  }

	}
