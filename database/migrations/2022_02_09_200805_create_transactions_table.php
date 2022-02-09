<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->bigInteger('invoice_id');
            $table->float('invoice_value');
            $table->tinyInteger('type'); // 0->buy-connects, 1->pay for task
            $table->string('invoice_status');
            $table->string('invoice_reference');
            $table->string('expiry_date');
            $table->string("expire_time");
            $table->string("paid_currency");
            $table->string("card_number");
            $table->string("payment_gateway");
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
        Schema::dropIfExists('transactions');
    }
}
