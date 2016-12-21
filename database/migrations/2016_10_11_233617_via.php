<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Via extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
	Schema::create('vias', function(Blueprint $table) {
	  $table->increments('id');
	  $table->unsignedInteger('city_id')->nullable();
	  $table->unsignedInteger('order_id')->nullable();
	  $table->unsignedInteger('position')->nullable();
	  $table->timestamps();
	  $table->foreign('city_id')->references('id')->on('cities');
	  $table->foreign('order_id')->references('id')->on('orders');
	});
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
	Schema::drop('vias');
  }

}
