<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ユーザーID
            $table->string('username', 30);
            $table->string('email', 50)->unique();
            $table->string('password', 255); // ハッシュ化後は長めに
            $table->boolean('is_admin')->default(false);
            $table->boolean('notification')->default(true);
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
