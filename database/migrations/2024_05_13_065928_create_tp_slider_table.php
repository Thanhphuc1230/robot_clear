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
        Schema::create('tp_slider', function (Blueprint $table) {
            $table->id('id_slider');
            $table->uuid();
            $table->string('name_vn');
            $table->text('link')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('avatar')->nullable();
            $table->integer('stt')->default(1);
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
        Schema::dropIfExists('tp_slider');
    }
};
