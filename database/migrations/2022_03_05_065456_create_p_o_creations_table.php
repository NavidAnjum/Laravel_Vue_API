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
            $table->integer('id')->unique();
            $table->string('po_number')->primary();
            $table->string('pr_number');
            $table->date('date');
            $table->string('lc_buyer');
            $table->string('supplier');
            $table->string('invoice');
            $table->string('lc_number');
            $table->string('bales');
            $table->string('total_kgs');
            $table->string('name_of_mats');
            $table->foreign('pr_number')->references('pr_number')->on('p_r_creations');
           // $table->foreign('pr_number')->references('p_r_creation_pr_number')->on('p_r_creations');
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
