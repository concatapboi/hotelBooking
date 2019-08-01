<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelFollowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_following', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')
            ->references('user_id')->on('customer')
            ->onDelete('cascade');
            $table->foreign('hotel_id')
            ->references('id')->on('hotel')
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
        Schema::dropIfExists('hotel_following');
    }
}
