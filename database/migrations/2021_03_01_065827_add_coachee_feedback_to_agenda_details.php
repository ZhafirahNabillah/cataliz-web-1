<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoacheeFeedbackToAgendaDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda_details', function (Blueprint $table) {
            $table->dropColumn(['attachment', 'feedback']);

            $table->string('attachment_from_coach')->nullable();
            $table->string('feedback_from_coach',1000)->nullable();
            $table->string('attachment_from_coachee')->nullable();
            $table->string('feedback_from_coachee',1000)->nullable();
            $table->float('rating_from_coachee',2,1)->nullable();
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
