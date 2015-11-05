<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoughtPackagesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_packages_images', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('bought_packages_id')->unsigned();
            $table->foreign('bought_packages_id')->references('id')->on('bought_packages');

            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('images');
            
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
        Schema::drop('bought_packages_images');
    }
}
