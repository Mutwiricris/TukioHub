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
        Schema::table('organizers', function (Blueprint $table) {
            // Add manager_id column
            $table->foreignId('manager_id')->nullable()->after('user_id')->constrained('organizer_managers')->onDelete('cascade');
            
            // Add is_primary flag to identify the main organizer profile for a manager
            $table->boolean('is_primary')->default(false)->after('is_verified');
            
            // Add index for performance
            $table->index(['manager_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizers', function (Blueprint $table) {
            // Drop foreign key and index first
            $table->dropForeign(['manager_id']);
            $table->dropIndex(['manager_id', 'is_primary']);
            
            // Drop columns
            $table->dropColumn(['manager_id', 'is_primary']);
        });
    }
};
