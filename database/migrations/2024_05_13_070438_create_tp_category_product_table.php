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
        Schema::create('tp_category_product', function (Blueprint $table) {
            $table->id('id_category_product');
            $table->uuid()->unique();
            $table->string('name_vn');
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->string('avatar')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('hot')->default(0);
            $table->integer('stt')->default(0)->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->timestamps();

            // Add indexes
            $table->index('slug');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_category_product');
    }
};
