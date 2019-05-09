<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('verified');
            $table->string('credit_card');
            $table->integer('rank_point');
            $table->string('name');
            $table->string('meta_name');
            $table->string('tax_code');
            $table->double('review_point');
            $table->string('fax_number');
            $table->integer('coin');
            $table->integer('hotel_type_id')->unsigned()->unique(); 
            $table->integer('hotel_manager_id')->unsigned()->unique(); 
            $table->timestamps();
            $table->foreign('hotel_type_id')
            ->references('id')->on('hotel_type')
            ->onDelete('cascade');
            $table->foreign('hotel_manager_id')
            ->references('user_id')->on('hotel_manager')
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
        Schema::dropIfExists('hotel');
    }
}
