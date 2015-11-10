<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubbrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subbrands', function (Blueprint $table) {
            $table->increments('id');

            $table->char('name', 10);

            $table->text('description', 1000);

            $table->char('landing_description', 200);

            $table->char('caption', 40);

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
        Schema::drop('subbrands');
    }
}
