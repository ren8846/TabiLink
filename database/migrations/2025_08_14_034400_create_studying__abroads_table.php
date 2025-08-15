<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('studying_abroads', function (Blueprint $table) {
            $table->id('studying_abroad_id');
            $table->boolean('is_studying_abroad')->default(false);
            $table->boolean('has_studied_abroad')->default(false);
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('studying_abroads');
    }
};

