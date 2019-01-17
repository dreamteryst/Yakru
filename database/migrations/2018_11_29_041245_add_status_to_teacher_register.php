<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToTeacherRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_registers', function (Blueprint $table) {
            $table->enum('status', ['accept', 'unaccept'])->default('unaccept');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_registers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
