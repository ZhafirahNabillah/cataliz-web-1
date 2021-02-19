<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_details', function (Blueprint $table) {
            $table->id();
      			$table->integer('agenda_id');
            $table->string('session_name');
      			$table->string('topic')->nullable();
      			$table->date('date')->nullable();
      			$table->time('time')->nullable();
      			$table->string('media')->nullable();
      			$table->string('media_url')->nullable();
      			$table->integer('duration')->nullable();
      			$table->string('status');
            $table->string('attachment',255)->nullable();
            $table->string('feedback',10000)->nullable();
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
        Schema::dropIfExists('agenda_details');
    }
}
