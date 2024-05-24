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
        Schema::create('tp_new', function (Blueprint $table) {
            $table->id('id_new');
            $table->uuid('uuid')->unique();
            $table->string('name_vn');
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->string('avatar')->nullable();
            $table->text('intro_vn');
            $table->text('intro_en')->nullable();
            $table->longText('content_vn');
            $table->longText('content_en')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('stt')->default(1)->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')->references('id_category_new')->on('tp_category_new')->onDelete('cascade');

            // Add indexes
            $table->index('slug');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_new');
    }
};
