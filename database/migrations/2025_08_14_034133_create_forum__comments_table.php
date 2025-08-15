<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id('forum_comment_id');
            $table->text('forum_comment_content');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('forum_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forum_id')->references('forum_id')->on('forums')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('forum_comments');
    }
};
