<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('my_post_images', function (Blueprint $table) {
            $table->id('my_post_image_id');
            $table->string('mypost_stock_image', 300);
            $table->unsignedBigInteger('mypost_history_id');
            $table->timestamps();

            $table->foreign('mypost_history_id')->references('mypost_history_id')->on('mypost_histories')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('my_post_images');
    }
};
