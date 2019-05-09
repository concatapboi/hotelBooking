<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');
            $table->string('description');
            $table->integer('max_adult_amount');
            $table->integer('max_child_amount');
            $table->double('room_size');
            $table->integer('amount');
            $table->integer('room_mode_id')->unsigned();
            $table->integer('room_type_id')->unsigned();
            $table->timestamps();
            $table->foreign('room_mode_id')
            ->references('id')->on('room_mode')
            ->onDelete('cascade');
            $table->foreign('room_type_id')
            ->references('id')->on('room_type')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room');
    }
}
