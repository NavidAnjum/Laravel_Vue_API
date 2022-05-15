<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropQuanityQualityFromPRCreatonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_r_creations', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('quality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_r_creations', function (Blueprint $table) {
            //
        });
    }
}
