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
        Schema::create('tp_menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->uuid();
            $table->string('name_vn');
            $table->string('name_en')->nullable();
            $table->string('link')->nullable();;
            $table->string('slug');
            $table->string('type',50)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();// id parent
            $table->unsignedBigInteger('object_id')->nullable(); //id của table chính
            $table->unsignedBigInteger('stt')->default(1);
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
        Schema::dropIfExists('tp_menu');
    }
};
