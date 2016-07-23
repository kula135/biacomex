<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clients extends Migration {

  /**
   * Create table clients.
   *
   * @return void
   */
  public function up() {
    Schema::create('clients', function(Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('companies_id')->nullable();
      $table->string('firstname');
      $table->string('lastname');
      $table->string('mail');
      $table->string('phone')->nullable();
      $table->timestamps();
      $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
    });
  }

  /**
   * Drop table clients.
   *
   * @return void
   */
  public function down() {
    Schema::drop('clients');
  }

}
