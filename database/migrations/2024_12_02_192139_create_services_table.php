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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Service title
        $table->text('description')->nullable(); // Description of the service
        $table->string('icon_class')->nullable(); // For FontAwesome or similar icons
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
