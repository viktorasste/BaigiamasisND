<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        'model',
//        'type',
//        'year',
//        'weight',
//        'max_weight',
//        'description',
        Schema::create('strollers', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('type');
            $table->integer('year');
            $table->integer('weight');
            $table->integer('max_weight');
            $table->longText('description');
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
        Schema::dropIfExists('strollers');
    }
};
