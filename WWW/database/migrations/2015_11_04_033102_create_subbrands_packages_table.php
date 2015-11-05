<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubbrandsPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subbrands_packages', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('subbrand_id')->unsigned();
            $table->foreign('subbrand_id')->references('id')->on('subbrands');

            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');

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
        Schema::drop('subbrands_packages');
    }
}
