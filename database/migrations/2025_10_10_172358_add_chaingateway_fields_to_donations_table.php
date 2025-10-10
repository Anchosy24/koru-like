<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add ChainGateway payment fields only if they don't exist
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'payment_id')) {
                $table->string('payment_id')->nullable()->after('status');
            }
            if (!Schema::hasColumn('donations', 'payment_address')) {
                $table->string('payment_address')->nullable()->after('status');
            }
            if (!Schema::hasColumn('donations', 'transaction_hash')) {
                $table->string('transaction_hash')->nullable()->after('status');
            }
        });

        // First, temporarily expand the ENUM to include both old and new values
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending', 'done', 'completed', 'failed', 'expired', 'cancelled') DEFAULT 'pending'");
        
        // Convert all 'done' status to 'completed'
        DB::table('donations')
            ->where('status', 'done')
            ->update(['status' => 'completed']);
        
        // Finally, remove 'done' from the ENUM
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending', 'completed', 'failed', 'expired', 'cancelled') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert completed status back to done
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending', 'done', 'completed', 'failed', 'expired', 'cancelled') DEFAULT 'pending'");
        
        DB::table('donations')
            ->where('status', 'completed')
            ->update(['status' => 'done']);
            
        Schema::table('donations', function (Blueprint $table) {
            if (Schema::hasColumn('donations', 'payment_id')) {
                $table->dropColumn('payment_id');
            }
            if (Schema::hasColumn('donations', 'payment_address')) {
                $table->dropColumn('payment_address');
            }
            if (Schema::hasColumn('donations', 'transaction_hash')) {
                $table->dropColumn('transaction_hash');
            }
        });

        // Revert status enum to original values
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending', 'done') DEFAULT 'pending'");
    }
};