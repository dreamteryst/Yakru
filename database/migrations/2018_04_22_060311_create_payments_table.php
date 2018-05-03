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
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('bank_id');
            $table->datetime('transferred_at');
            $table->decimal('amount', 8, 2);
            $table->string('slip')->comment('หลักฐานการโอนเงิน');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('bank_id')->references('id')->on('banks');

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
