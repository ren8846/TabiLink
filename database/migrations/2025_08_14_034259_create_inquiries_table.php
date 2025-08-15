<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id('inquiry_id');
            $table->string('name', 100);
            $table->string('title', 255);
            $table->text('body');
            $table->boolean('is_answered')->default(false);
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('inquiries');
    }
};
