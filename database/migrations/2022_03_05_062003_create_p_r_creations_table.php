<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePRCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_r_creations', function (Blueprint $table) {
            $table->string('pr_number')->primary();
            $table->integer('id')->unique();
            $table->date('date');
            $table->string('name_of_raw_matrial');
            $table->string('quantity');
            $table->string('quality');
            $table->string('remarks');
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
        Schema::dropIfExists('p_r_creations');
    }
}
