<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('worlds', function (Blueprint $table) {
            $table->id('world_id');
            $table->string('state', 30)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('region', 20)->nullable(); // 例: Asia, Europe
            $table->unsignedBigInteger('survey_id')->nullable();
            $table->timestamps();

            $table->foreign('survey_id')->references('survey_id')->on('surveys')->nullOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('worlds');
    }
};
