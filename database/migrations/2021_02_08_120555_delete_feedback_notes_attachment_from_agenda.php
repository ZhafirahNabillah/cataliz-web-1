<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFeedbackNotesAttachmentFromAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // drop column attachent, feedback, notes
        Schema::table('agendas', function (Blueprint $table) {
           $table->dropColumn('attachment');
           $table->dropColumn('feedback');
           $table->dropColumn('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agenda', function (Blueprint $table) {
            //
        });
    }
}
