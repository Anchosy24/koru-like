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
        Schema::table('donations', function (Blueprint $table) {
            // Remove payment_id column
            if (Schema::hasColumn('donations', 'payment_id')) {
                $table->dropColumn('payment_id');
            }
            
            // Add confirmed_at timestamp column
            if (!Schema::hasColumn('donations', 'confirmed_at')) {
                $table->timestamp('confirmed_at')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Remove confirmed_at column
            if (Schema::hasColumn('donations', 'confirmed_at')) {
                $table->dropColumn('confirmed_at');
            }
            
            // Add back payment_id column
            if (!Schema::hasColumn('donations', 'payment_id')) {
                $table->string('payment_id')->nullable()->after('status');
            }
        });
    }
};