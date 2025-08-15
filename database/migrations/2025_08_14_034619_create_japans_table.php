<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('japans', function (Blueprint $table) {
            $table->id('japan_id');
            $table->string('district', 50)->nullable();
            $table->string('prefecture', 30)->nullable();
            $table->string('facility_name', 100)->nullable();
            $table->integer('salary')->nullable();
            $table->string('site', 100)->nullable();
            $table->string('url', 200)->nullable();
            $table->string('image_url', 300)->nullable();
            $table->unsignedBigInteger('world_id')->nullable(); // 後でFK追加可（worlds）
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('japans');
    }
};
