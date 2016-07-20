<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('companys', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->string('nip', 13)->unique();
      $table->string('address')->nullable();
      $table->string('code', 6)->nullable();
      $table->string('city')->nullable();
      $table->timestamps();
    });

    Schema::create('clients', function(Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('companys_id')->nullable();
      $table->string('firstname');
      $table->string('lastname');
      $table->string('mail');
      $table->string('phone')->nullable();
      $table->timestamps();
      $table->foreign('companys_id')->references('id')->on('companys')->onDelete('cascade');
    });
    
    Schema::create('orders', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('companys_id')->nullable();
      $table->unsignedInteger('clients_id')->nullable();
      $table->string('tripfrom')->nullable();
      $table->string('tripto')->nullable();
      $table->text('tripinfo')->nullable();
      $table->string('distance')->nullable();
      $table->date('datefrom');
      $table->date('dateto');
      $table->date('requestdate')->nullable();
      $table->date('answerdate')->nullable();
      $table->text('price');
      $table->text('priceinfo')->nullable();
      $table->text('info')->nullable();
      $table->timestamps();
      $table->foreign('companys_id')->references('id')->on('companys')->onDelete('cascade');
      $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('orders');
    Schema::drop('clients');
    Schema::drop('companys');
  }

}
