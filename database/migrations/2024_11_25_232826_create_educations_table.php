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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('degree');
            $table->string('institution');
            $table->string('start_year', 4);
            $table->string('end_year', 4)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->boolean('is_active')->default(1);
            $table->softDeletes();  
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropSoftDeletes();
        });
    }
};
