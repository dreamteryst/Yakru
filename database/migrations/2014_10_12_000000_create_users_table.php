<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 120)->unique();
            $table->string('password');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('degree')->comment('ระดับปริญญา')->nullable();
            $table->string('level')->comment('ชั้นปี')->nullable();
            $table->string('institution')->comment('สถาบัน')->nullable();
            $table->integer('rank')->default(1);
            $table->enum('type', ['Master', 'Teacher', 'Accounting', 'Student'])->default('Student');
            $table->decimal('money', 10, 2)->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
