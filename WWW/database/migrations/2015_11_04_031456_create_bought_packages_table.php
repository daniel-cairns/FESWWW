<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoughtPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_packages', function (Blueprint $table) {
            $table->increments('id');

            $table->smallInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->tinyInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');

            $table->enum('status', ['pending', 'printing', 'payed', 'stopped', 'sent']);

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
        Schema::drop('bought_packages');
    }
}
