<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->nullable();
      $table->integer('status')->default(1);
      $table->string('name');
      $table->string('address');
      $table->string('email');
      $table->string('phone');
      $table->integer('total');
      $table->integer('subtotal');
      $table->integer('tax');
      $table->string('_token');
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('orders');
  }
}
