<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('region_likes', function (Blueprint $table) {
            $table->id('region_like_id');
            $table->unsignedBigInteger('japan_id'); // 後でjapansにFK追加可
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('region_likes');
    }
};
