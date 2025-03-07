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
        Schema::create('data_bundles', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('plan')->nullable();
            $table->integer('network_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->double('price', 5,2);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('deleted')->default(0);
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
        Schema::dropIfExists('data_bundles');
    }
};
