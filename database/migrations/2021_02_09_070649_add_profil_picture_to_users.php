<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilPictureToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profil_picture')->default(asset('assets/images/avatars/cataliz.jpg'));
            $table->string('background_picture')->default('https://image.freepik.com/free-photo/cyborg-hand-holding-bulb-lamp-idea-concept-with-start-up-icon-connected-3d-rendering_110893-1792.jpg');
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
            $table->dropColumn('profil_picture');
            $table->dropColumn('background_picture');
        });
    }
}
