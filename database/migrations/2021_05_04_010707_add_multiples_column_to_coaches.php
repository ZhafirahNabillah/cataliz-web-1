<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultiplesColumnToCoaches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coaches', function (Blueprint $table) {
            $table->string('skills_description_title')->nullable();
            $table->string('skills_description_overview')->nullable();
            $table->text('education_id')->nullable();
            $table->text('employment_id')->nullable();
            $table->text('language_id')->nullable();
            $table->boolean('beginner_status')->default(0);
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->string('current_position')->nullable();
            $table->date('entry_month')->nullable();
            $table->date('entry_year')->nullable();
            $table->date('out_month')->nullable();
            $table->date('out_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coaches', function (Blueprint $table) {
            //
        });
    }
}
