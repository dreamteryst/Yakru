<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_units', function (Blueprint $table) {
            $table->unsignedInteger('schedule_id');
            $table->unsignedInteger('unit_id');
            $table->primary(['schedule_id', 'unit_id']);

            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('unit_id')->references('id')->on('units');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_units');
    }
}
