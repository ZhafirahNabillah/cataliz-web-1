<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationDateStatusToAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            //
            $table->string('duration',10)->nullable();
            $table->date('date')->nullable();
            $table->enum('status',['unschedule','scheduled'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            //
            $table->dropColumn('duration');
            $table->dropColumn('date');
            $table->dropColumn('status');
        });
    }
}
