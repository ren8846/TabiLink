<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('posts__images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');      // 親: posts.post_id
            $table->string('path', 255);                // 画像パス or フルURL
            $table->unsignedSmallInteger('sort_order')->default(1);
            $table->timestamps();
            $table->index('post_id');
            // 必要なら外部キー
            // $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts__images');
    }
};
