<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp_number');
            $table->string('instance');
            $table->string('profession');
            $table->string('address');
            $table->text('goals');
            $table->string('book_demo');
            $table->string('book_date');
            $table->enum('session_coaching', ['0', '1', '2', '3'])->default('0');
            $table->enum('session_training', ['0', '1', '2', '3'])->default('0');
            $table->enum('session_mentoring', ['0', '1', '2', '3'])->default('0');
            $table->enum('status', ['pending', 'reservation'])->default('pending');
            $table->string('price');
            $table->integer('program_id')->unsigned();
            $table->enum('bank', ['bca', 'bri', 'mandiri', 'bni'])->nullable();
            $table->string('payment')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
