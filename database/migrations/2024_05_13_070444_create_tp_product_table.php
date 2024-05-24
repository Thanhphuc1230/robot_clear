<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_product', function (Blueprint $table) {
            $table->id('id_product');
            $table->uuid('uuid')->unique();
            $table->string('name_vn');
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->string('brand');
            $table->text('intro_vn');
            $table->text('intro_en')->nullable();
            $table->decimal('price', 15, 2); 
            $table->decimal('discount', 5, 2)->nullable(); 
            $table->longText('content_vn');
            $table->longText('content_en')->nullable();
            $table->string('avatar');
            $table->longText('image_detail')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('hot')->default(0);
            $table->tinyInteger('stt')->default(1);
            $table->string('meta_keywords');
            $table->text('meta_description');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id_category_product')->on('tp_category_product')->onDelete('cascade');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_product');
    }
};
