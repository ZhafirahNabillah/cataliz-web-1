<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnAttachmentFromCoachAndFeedbackFromCoachOnAgendaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda_details', function (Blueprint $table) {
            $table->dropColumn('attachment_from_coach');
            $table->dropColumn('feedback_from_coach');
            $table->dropColumn('attachment_from_coachee');
            $table->dropColumn('feedback_from_coachee');
            $table->dropColumn('rating_from_coachee');
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
