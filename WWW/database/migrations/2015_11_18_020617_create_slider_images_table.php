<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('images');

            $table->integer('subbrand_id')->unsigned();
            $table->foreign('subbrand_id')->references('id')->on('subbrands');
            
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
        Schema::drop('slider_images');
    }
}
