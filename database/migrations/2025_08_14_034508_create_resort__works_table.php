<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('resort_works', function (Blueprint $table) {
            $table->id('resort_work_id');
            $table->boolean('is_on_resort_work')->default(false);
            $table->boolean('has_done_resort_work')->default(false);
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('resort_works');
    }
};
