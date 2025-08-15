<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id('post_image_id');
            $table->string('post_stock_image', 255); // ストック用画像パス
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('post_images');
    }
};

