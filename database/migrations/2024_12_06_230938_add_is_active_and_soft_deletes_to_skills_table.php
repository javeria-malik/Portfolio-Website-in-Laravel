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
        Schema::table('skills', function (Blueprint $table) {
            // Add the 'is_active' column if it doesn't exist
            if (!Schema::hasColumn('skills', 'is_active')) {
                $table->boolean('is_active')->default(1); // Add the 'is_active' column with a default value of 1
            }

            // Add the 'deleted_at' column if it doesn't exist (for soft deletes)
            if (!Schema::hasColumn('skills', 'deleted_at')) {
                $table->softDeletes(); // Adds the 'deleted_at' column for soft deletes
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            if (Schema::hasColumn('skills', 'is_active')) {
                $table->dropColumn('is_active'); // Drop the 'is_active' column
            }

            if (Schema::hasColumn('skills', 'deleted_at')) {
                $table->dropSoftDeletes(); // Drop the 'deleted_at' column
            }
        });
    }
};
