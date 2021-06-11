<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('coach_id')->nullable();
            $table->double('awarness')->nullable();
            $table->double('mindset')->nullable();
            $table->double('behaviour')->nullable();
            $table->double('engagement')->nullable();
            $table->double('result')->nullable();
            $table->string('note', 1000)->nullable();
            $table->integer('coachee_id')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
