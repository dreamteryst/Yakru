<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_tag', function (Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('tag_id');
            $table->primary(['course_id', 'tag_id']);

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('tag_id')->references('id')->on('tags');

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
        Schema::dropIfExists('course_tag');
    }
}
