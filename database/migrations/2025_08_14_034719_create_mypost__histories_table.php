<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mypost_histories', function (Blueprint $table) {
            $table->id('mypost_history_id');
            $table->string('mypost_tag', 255)->nullable();
            $table->string('mypost_image', 255)->nullable();
            $table->text('mypost_content');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('post_tag_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('profile_id')->on('profiles')->onDelete('cascade');
            $table->foreign('post_tag_id')->references('post_tag_id')->on('post_tag_ids')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('mypost_histories');
    }
};
