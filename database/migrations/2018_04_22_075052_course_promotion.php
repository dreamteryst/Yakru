<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoursePromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_promotions', function (Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('promotion_id');
            $table->primary(['course_id', 'promotion_id']);

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('promotion_id')->references('id')->on('promotions');
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
        Schema::dropIfExists('course_promotions');
    }
}
