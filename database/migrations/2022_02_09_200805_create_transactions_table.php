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
        /*
        'trans_ref', 
        'trans_amount', 
        'trans_currency', 
        'trans_desc',
        'res_status', 
        'res_msg', 
        'trans_time',
        'payment_method', 
        'payment_card', 
        'ipn_trace'
        */
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_ref');
            $table->string('trans_amount');
            $table->string('trans_currency');
            $table->string('trans_desc');
            $table->string('res_status', 5);
            $table->string('res_msg')->nullable();
            $table->string('trans_time')->nullable();
            $table->string('payment_method')->nullable();
            $table->string("payment_card")->nullable();
            $table->string("ipn_trace")->nullable();
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
