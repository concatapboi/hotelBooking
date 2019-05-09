<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRoomTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_room_type', function (Blueprint $table) {
            $table->integer('service_id')->unsigned();
            $table->integer('room_type_id')->unsigned();
            $table->timestamps();
            $table->foreign('service_id')
            ->references('id')->on('service')
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
        Schema::dropIfExists('service_room_type');
    }
}
