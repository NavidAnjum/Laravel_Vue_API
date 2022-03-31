<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_models', function (Blueprint $table) {
            $table->string('po_number')->primary();
            $table->string('pr_number');
            $table->foreign('pr_number')->references('p_r_creation_pr_number')->on('p_r_creations');
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
        Schema::dropIfExists('test_models');
    }
}
