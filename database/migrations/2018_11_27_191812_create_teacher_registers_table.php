<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('date_of_brith');
            $table->string('attach')->nullable();
            $table->text('skill');
            $table->text('bio');
            $table->string('cityzen_id');
            $table->string('photo_id');
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
        Schema::dropIfExists('teacher_registers');
    }
}
