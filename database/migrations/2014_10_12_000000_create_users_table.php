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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->mediumInteger('ref_id')->index()->nullable();
            $table->string('user_role')->default('user');
            $table->string('phone')->nullable();
            $table->double('balance',20,3)->default(0);
            $table->double('bonus',20,3)->default(0);
            $table->tinyInteger('phone_verify')->default(0);
            $table->tinyInteger('blocked')->default(0);
            $table->mediumInteger('trxpin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
