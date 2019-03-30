<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('allow_country')->nullable();
            $table->text('block_country')->nullable();
            $table->string('time_zone')->default('UTC');
            $table->string('currency')->default('USD');
            $table->text('settings')->nullable();
            $table->text('translation')->nullable();
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('organizers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
