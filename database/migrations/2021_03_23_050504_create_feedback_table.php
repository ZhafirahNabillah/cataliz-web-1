<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('agenda_details_id');
            $table->string('attachment_from_coach')->nullable();
            $table->string('feedback_from_coach',1000)->nullable();
            $table->string('attachment_from_coachee')->nullable();
            $table->string('feedback_from_coachee',1000)->nullable();
            $table->float('rating_from_coachee',2,1)->nullable();
            $table->integer('owner_id');
            $table->integer('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
