<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_active')->default(1); // Default to active (1)
            $table->softDeletes(); // Adds the soft delete functionality
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('is_active'); // Drops the is_active column
            $table->dropSoftDeletes(); // Removes soft delete functionality
        });
    }
};
