<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topup_id');
            $table->unsignedInteger('bank_id');
            $table->unsignedInteger('user_id');
            $table->datetime('transferred_at');
            $table->decimal('amount', 20, 2);
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->string('slip')->comment('หลักฐานการโอนเงิน');

            $table->foreign('topup_id')->references('id')->on('topups');
            $table->foreign('bank_id')->references('id')->on('banks');
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
        Schema::dropIfExists('payments');
    }
}
