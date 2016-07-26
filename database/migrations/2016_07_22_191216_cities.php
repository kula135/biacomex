<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cities extends Migration {

  /**
   * Create table cities.
   *
   * @return void
   */
  public function up() {
    Schema::create('cities', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name')->index();
      $table->timestamps();
    });
  }

  /**
   * Drop table cities.
   *
   * @return void
   */
  public function down() {
    Schema::drop('cities');
  }

}
