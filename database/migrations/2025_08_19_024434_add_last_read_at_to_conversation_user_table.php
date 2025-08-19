<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('conversation_user', function (Blueprint $table) {
            if (!Schema::hasColumn('conversation_user', 'last_read_at')) {
                $table->timestamp('last_read_at')->nullable()->after('updated_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conversation_user', function (Blueprint $table) {
            if (Schema::hasColumn('conversation_user', 'last_read_at')) {
                $table->dropColumn('last_read_at');
            }
        });
    }
};
