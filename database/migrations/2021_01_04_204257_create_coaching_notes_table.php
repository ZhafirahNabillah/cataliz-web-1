<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('agenda_detail_id');
            $table->string('subject');
            $table->string('summary', 10000);
            $table->string('attachment')->nullable();
            $table->string('send_to_email')->nullable();
            $table->integer('owner_id');
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
        Schema::dropIfExists('coaching_notes');
    }
}
