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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('whatsapp_number');
            $table->string('instance');
            $table->string('profession');
            $table->string('address');
            $table->text('goals');
            $table->enum('program', ['starco', 'scmp']);
            $table->enum('book_demo', ['coaching', 'training', 'mentoring']);
            $table->date('book_date');
            $table->enum('session_coaching', ['0', '1', '2', '3']);
            $table->enum('session_training', ['0', '1', '2', '3']);
            $table->enum('session_mentoring', ['0', '1', '2', '3']);
            $table->enum('status', ['pending', 'reservation'])->default('pending');
            $table->integer('price');
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
