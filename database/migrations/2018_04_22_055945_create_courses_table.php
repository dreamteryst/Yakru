<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->string('course_picture');
            $table->string('course_video');
            $table->string('course_name');
            $table->string('course_subtitle');
            $table->mediumText('course_description');
            $table->decimal('course_price', 8, 2);
            $table->decimal('course_discounted', 8, 2);
            $table->integer('course_limit')->default(0);
            $table->text('requirements')->nullable();
            $table->text('result')->nullable();
            $table->text('tags')->nullable();
            $table->enum('type', ['video', 'live'])->default('video');
            $table->string('secret')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('courses');
    }
}
