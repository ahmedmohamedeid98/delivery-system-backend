<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('task_status'); // open - in progress - closed
            $table->text('description');
            $table->integer('budget'); // pay for service delivery
            $table->integer('order_cost')->nullable();
            $table->integer('payment_method'); // 0->cash, 1->pay in advance
            $table->boolean('required_invoice')->default(false);
            $table->string('note');
            $table->integer('order_status'); // searching - recived - notfound
            $table->integer('travel_status'); // start - nearby - arrive
            $table->dateTime('delivery_date');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('delivery_location_id')->references('id')->on('delivery_locations');
            $table->foreignId('target_location_id')->references('id')->on('target_locations');
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
        Schema::dropIfExists('tasks');
    }
}
