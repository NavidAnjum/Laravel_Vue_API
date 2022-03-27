<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNameOfRawMaterialsTable extends Migration
{

    public function up()
    {
        Schema::create('name_of__raw__materials', function (Blueprint $table) {
            $table->id();
            $table->string('item_code');
            $table->string('name_of_raw_material');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('name_of__raw__materials');
    }
}
