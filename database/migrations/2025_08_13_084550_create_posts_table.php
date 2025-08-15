<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id'); // 投稿ID（自動採番）
            $table->string('post_tag', 255)->nullable(); // 投稿タグ
            $table->string('post_image', 255)->nullable(); // 投稿画像URL
            $table->text('post_content'); // 投稿内容
            $table->string('post_genre', 100)->nullable(); // 投稿ジャンル
            $table->unsignedBigInteger('users_id'); // ユーザーID
            $table->timestamps(); // created_at, updated_at 自動作成

            // 外部キー制約
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

