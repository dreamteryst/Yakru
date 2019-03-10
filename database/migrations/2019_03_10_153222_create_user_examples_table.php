<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_examples', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('example_id');
            $table->integer('point');
            $table->text('answers');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->timestamps();

            $table->foreign('example_id')->references('id')->on('examples');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_examples');
    }
}
