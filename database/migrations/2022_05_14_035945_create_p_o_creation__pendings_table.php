<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePOCreationPendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_o_creation__pendings', function (Blueprint $table) {
            $table->id();
            $table->string('po_number');
            $table->string('pr_number');
            $table->date('date');
            $table->string('lc_buyer');
            $table->string('supplier');
            $table->string('invoice');
            $table->string('lc_number');
            $table->string('bales');
            $table->string('total_kgs');
            $table->string('name_of_mats');
            $table->string('approval');
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
        Schema::dropIfExists('p_o_creation__pendings');
    }
}
