<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllquantityColumnToPRCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_r_creations', function (Blueprint $table) {
            $table->string('l_quantity');
            $table->string('s_quantity');
            $table->string('m_quantity');


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
