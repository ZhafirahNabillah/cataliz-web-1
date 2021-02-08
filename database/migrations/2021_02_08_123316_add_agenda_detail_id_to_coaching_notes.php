<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgendaDetailIdToCoachingNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coaching_notes', function (Blueprint $table) {
            //
            $table->integer('agenda_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coaching_notes', function (Blueprint $table) {
            //
            $table->dropColumn('agenda_detail_id');
        });
    }
}
