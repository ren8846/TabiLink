<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Breeze 既定
            $table->string('username')->nullable()->unique(); // 追加（任意）
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();                        // 「私を覚える」で必要
            $table->boolean('is_admin')->default(false);
            $table->boolean('notification')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
