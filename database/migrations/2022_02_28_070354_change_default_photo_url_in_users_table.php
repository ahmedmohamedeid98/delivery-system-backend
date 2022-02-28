<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultPhotoUrlInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo_url')->default('https://firebasestorage.googleapis.com/v0/b/edelivery-e3c58.appspot.com/o/uploads%2Fdefault-profile-image-2122202.png?alt=media&token=dcbd78c1-d7bd-4869-8d10-f990997a9ff0')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
