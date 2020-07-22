<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fullname');
            $table->string('email');
            $table->string('date_birth');
            $table->string('phone');
            $table->date('date_arrival');
            $table->integer('date_checkout');
            $table->boolean('admin_confirmed')->default(false);
            $table->integer('price_total');
            $table->integer('payment_confirmed')->default(false);
//            $table->foreignId('room_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
