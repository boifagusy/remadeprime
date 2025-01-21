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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id')->index();
            $table->string('type')->nullable();
            $table->string('code')->nullable();
            $table->double('amount',20,2)->nullable();
            $table->double('charge',20,2)->default(0);
            $table->double('old_balance',20,2)->nullable();
            $table->double('new_balance',20,2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('message')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
