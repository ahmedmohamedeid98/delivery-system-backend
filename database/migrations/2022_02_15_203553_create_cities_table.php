<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
            $table->string('city_name_ar', 40);
            $table->string('city_name_en', 40);
        });
    } // 2022_02_15_203521

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
