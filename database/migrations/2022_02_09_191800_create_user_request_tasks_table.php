<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequestTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_request_tasks', function (Blueprint $table) {
            $table->foreignId('task_id')->references('id')->on('tasks');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->primary(['user_id', 'task_id']);
            $table->tinyInteger('approve_status');
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
        Schema::dropIfExists('user_request_tasks');
    }
}
