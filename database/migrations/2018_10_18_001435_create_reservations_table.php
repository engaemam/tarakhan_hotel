2018_10_17_220320_create_reservations_table.php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('a_id');
            $table->string('a_name');
            $table->string('a_email');
            $table->string('phone');
            $table->string('room');
            $table->string('room_no');
            $table->dateTimeTz('checkin');
            $table->dateTimeTz('checkout');
            $table->boolean('confirmed');
            $table->boolean('paid');
            $table->integer('payment');
            $table->integer('not_paid');
            $table->integer('total');
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
        Schema::dropIfExists('reservations');
    }
}
