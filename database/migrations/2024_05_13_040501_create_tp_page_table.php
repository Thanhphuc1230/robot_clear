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
        Schema::create('tp_page', function (Blueprint $table) {
            $table->id('id_page');
            $table->uuid()->unique();
            $table->string('name_vn');
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->longText('content_vn');
            $table->longText('content_en')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('stt')->default(1)->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('tp_page');
    }
};
