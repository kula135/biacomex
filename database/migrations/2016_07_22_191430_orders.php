<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration {

  /**
   * Create table orders.
   *
   * @return void
   */
  public function up() {
    Schema::create('orders', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('company_id')->nullable();
      $table->unsignedInteger('client_id')->nullable();
      $table->unsignedInteger('tripfrom_id')->nullable();
      $table->unsignedInteger('tripto_id')->nullable();
      $table->text('distance')->nullable();
      $table->text('tripinfo')->nullable();
      $table->date('datefrom');
      $table->date('dateto');
      $table->text('description')->nullable();
      $table->text('count')->nullable();
      $table->text('vehicle')->nullable();
      $table->text('price');
      $table->text('priceinfo')->nullable();
      $table->date('requestdate')->nullable();
      $table->date('answerdate')->nullable();
      $table->timestamps();
      $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
      $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
      $table->foreign('tripfrom_id')->references('id')->on('cities')->onDelete('cascade');
      $table->foreign('tripto_id')->references('id')->on('cities')->onDelete('cascade');
    });
  }

  /**
   * Drop table orders.
   *
   * @return void
   */
  public function down() {
    Schema::drop('orders');
  }

}
