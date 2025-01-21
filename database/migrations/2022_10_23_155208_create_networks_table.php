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
        Schema::create('networks', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name');
            $table->string('image')->nullable();
            $table->tinyInteger('swap')->default(0);
            $table->tinyInteger('data')->default(0);
            $table->tinyInteger('airtime')->default(0);
            $table->tinyInteger('cardpin')->default(0);
            $table->string('number')->nullable();
            $table->integer('rate')->nullable()->default(10);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('networks');
    }
};
