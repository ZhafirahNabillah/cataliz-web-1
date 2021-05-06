<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RestructureCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coaches', function (Blueprint $table) {
            //dropping column
            $table->dropColumn('current_position');
            $table->dropColumn('entry_month');
            $table->dropColumn('entry_year');
            $table->dropColumn('out_month');
            $table->dropColumn('out_year');
            $table->dropColumn('company');

            //renaming column
            $table->renameColumn('education_id', 'education');
            $table->renameColumn('employment_id', 'employment');
            $table->renameColumn('language_id', 'language');

            //create category column
            $table->string('category_id',255);
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
