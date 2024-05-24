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
        Schema::create('tp_category_new', function (Blueprint $table) {
            $table->id('id_category_new');
            $table->uuid();
            $table->string('name_vn');
            $table->string('name_en')->nullable();
            $table->string('slug');
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->integer('stt')->default(0)->nullable();
            $table->unsignedInteger('parent_id')->default(0);
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
        Schema::dropIfExists('tp_category_new');
    }
};
