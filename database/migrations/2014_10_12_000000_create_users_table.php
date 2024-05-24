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
            $table->uuid('uuid');
            $table->string('fullname', 255); 
            $table->string('username', 100)->nullable(); 
            $table->string('email', 255)->unique(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',80)->nullable();
            $table->tinyInteger('level')->default(3)->comment('1:Admin - 2:Staff - 3:User');
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('users');
    }
};
