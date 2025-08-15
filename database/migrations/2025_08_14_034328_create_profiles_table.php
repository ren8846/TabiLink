<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('profile_id');
            $table->string('name', 100);
            $table->char('gender', 1);
            $table->text('self_introduction')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('profile_images_id')->nullable(); // 参照先テーブル未定のためFKなし
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('profiles');
    }
};
