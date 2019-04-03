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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_reference');
            $table->string('transaction_id')->nullable();
            $table->integer('fee')->nullable();
            $table->date('order_date')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_cancelled')->default(0);
            $table->boolean('is_partially_refunded')->default(0);
            $table->boolean('is_refunded')->default(0);
            $table->unsignedBigInteger('game_id')->nullable();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('order_id');
        });
        Schema::dropIfExists('orders');

    }
}
