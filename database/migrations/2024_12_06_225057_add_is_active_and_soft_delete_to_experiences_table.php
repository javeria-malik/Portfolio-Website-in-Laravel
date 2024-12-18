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
    Schema::table('experiences', function (Blueprint $table) {
        $table->boolean('is_active')->default(1);  // Default to active
        $table->softDeletes();  // For soft delete functionality
    });
}

public function down()
{
    Schema::table('experiences', function (Blueprint $table) {
        $table->dropColumn('is_active');
        $table->dropSoftDeletes();
    });
}

    
    };
