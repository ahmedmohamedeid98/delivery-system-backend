<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('about')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('identity_status')->default(false);
            $table->string('country')->default('Egypt');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->float('total_rate')->default(0);
            $table->float('success_rate')->default(0);
            $table->integer('connects')->default(30);
            $table->float('earning_amount')->default(0);
            $table->float('spent_amount')->default(0);
            $table->float('total_orders_amount')->default(0);
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
        Schema::dropIfExists('profile');
    }
}
