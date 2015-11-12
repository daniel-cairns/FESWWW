<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Subbrand;
class AddSlugToSubbrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subbrands', function (Blueprint $table) {
            $table->string('slug')->after('caption');
        });

        $subbrands = Subbrand::all();
        foreach($subbrands as $subbrand) {
            $subbrand->slug = str_slug($subbrand->name);
            $subbrand->save();
        }
        
        Schema::table('subbrands', function (Blueprint $table) {
            $table->unique('slug');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subbrands', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
