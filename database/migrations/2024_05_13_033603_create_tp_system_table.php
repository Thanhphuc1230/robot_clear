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
        Schema::create('tp_system', function (Blueprint $table) {
            $table->id('id_system');
            // thông tin liên hệ
            $table->string('email',50);
            $table->string('email_alert',50)->nullable();
            $table->text('address')->nullable();
            $table->string('hotline',20)->nullable();
            $table->text('footer')->nullable();
            // socical media
            $table->string('link_facebook')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_zalo')->nullable();

            // Seo website
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('meta_name')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();

            // script cho google anlyst
            $table->text('header_js')->nullable();
            $table->text('body_js')->nullable();
            $table->text('footer_js')->nullable();
            $table->text('map')->nullable();
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
        Schema::dropIfExists('tp_system');
    }
};
