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
        Schema::create('network_trxes', function (Blueprint $table) {
            $table->id();            
            $table->integer('user_id')->index();
            $table->integer('network_id')->index();
            $table->integer('transaction_id')->index();
            $table->string('type')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->double('amount',20,2)->nullable();
            $table->double('charge',20,2)->default(0);
            $table->double('old_balance',20,2)->nullable();
            $table->double('new_balance',20,2)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('network_trxes');
    }
};
