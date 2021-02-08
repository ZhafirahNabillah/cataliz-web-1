<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentFeedbackToAgendaDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda_details', function (Blueprint $table) {
            //
            $table->string('attachment',255)->nullable();
            $table->string('feedback',10000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agenda_details', function (Blueprint $table) {
            //
        });
    }
}
