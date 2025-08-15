<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('forums', function (Blueprint $table) {
            $table->id('forum_id');
            $table->text('post_content');
            $table->unsignedBigInteger('forum_tag_id')->nullable(); // 後でFK追加可（forum_tags）
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('forum_comment_id')->nullable(); // 循環回避のためFKは貼らない
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('forums');
    }
};
