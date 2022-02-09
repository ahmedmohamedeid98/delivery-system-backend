<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->foreignId('sender_id')->references('id')->on('users');
            $table->foreignId('reciver_id')->references('id')->on('users');
            $table->foreignId('task_id')->references('id')->on('tasks');
            $table->float('rate');
            $table->string('content');
            $table->primary(['sender_id', 'reciver_id', 'task_id']);
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
        Schema::dropIfExists('feedback');
    }
}
