<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Companies extends Migration {

  /**
   * Create table companies.
   *
   * @return void
   */
  public function up() {
    Schema::create('companies', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('nip', 13)->unique();
      $table->string('address')->nullable();
      $table->string('code', 6)->nullable();
      $table->unsignedInteger('city_id')->nullable();
      $table->timestamps();
      $table->foreign('city_id')->references('id')->on('cities');
    });
  }

  /**
   * Drop table companies.
   *
   * @return void
   */
  public function down() {
    Schema::drop('companies');
  }

}
