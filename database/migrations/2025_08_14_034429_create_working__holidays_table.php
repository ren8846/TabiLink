<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('working_holidays', function (Blueprint $table) {
            $table->id('working_holiday_id');
            $table->boolean('is_on_working_holiday')->default(false);
            $table->boolean('has_done_working_holiday')->default(false);
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('working_holidays');
    }
};
