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
			$table->string('topic');
			$table->date('date');
			$table->time('time');
			$table->string('media')->nullable();
			$table->string('media_url')->nullable();
			$table->integer('duration');
			$table->string('status');
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
