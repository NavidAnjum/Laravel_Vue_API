<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePOCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_o_creations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('po_number');
            $table->string('lc_buyer');
            $table->string('supplier');
            $table->string('invoice');
            $table->string('lc_number');
            $table->string('bales');
            $table->string('total_kgs');

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
        Schema::dropIfExists('p_o_creations');
    }
}
