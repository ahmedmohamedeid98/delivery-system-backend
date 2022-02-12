<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdAndTaskIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('task_id')->nullable()->references('id')->on('tasks')->onDelete('cascade');
            $table->enum('trans_type', ['connects', 'order', 'service', 'refund']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('task_id');
            $table->dropForeign('user_id');
            $table->dropForeign('task_id');
        });
    }
}
