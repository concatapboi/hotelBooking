<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->integer('useful_point');
            $table->integer('customer_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('review');
    }
}
