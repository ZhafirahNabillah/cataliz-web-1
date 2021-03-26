<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResctructuredFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('feedback', function (Blueprint $table) {
            // $table->id();
            // $table->integer('agenda_details_id');

            //dropping column
            // $table->dropColumn('attachment_from_coach');
            $table->dropColumn('agenda_details_id');
            $table->dropColumn('attachment_from_coach');
            $table->dropColumn('feedback_from_coach');
            $table->dropColumn('attachment_from_coachee');
            $table->dropColumn('feedback_from_coachee');
            $table->dropColumn('rating_from_coachee');
            $table->dropColumn('owner_id');
            $table->dropColumn('client_id');

            //add new column
            $table->integer('agenda_detail_id');
            $table->string('feedback', 1000)->nullable();
            $table->string('attachment')->nullable();
            $table->string('rating')->nullable();
            $table->integer('user_id');
            $table->enum('from', ['coach','coachee'])->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
