<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('total_tickets')->default(0);
            $table->text('title');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->boolean('has_result_published')->default(false);
            $table->timestamp('result_published_at')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_approve')->nullable();
            $table->boolean('is_private')->default(false);
            $table->string('password')->nullable();
            $table->string('result')->nullable();
            $table->text('rules')->nullable();
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('organizers');
            $table->string('created_by')->default('organizer');
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('agents');
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
        Schema::dropIfExists('games');
    }
}
