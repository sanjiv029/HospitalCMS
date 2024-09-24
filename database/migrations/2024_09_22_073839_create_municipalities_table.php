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
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('muni_type_id')->constrained('municipality_types'); // Foreign key to municipality_types table
            $table->foreignId('district_id')->constrained()->onDelete('cascade'); // Foreign key to districts table
            $table->string('muni_code')->unique(); // Unique municipality code
            $table->string('muni_name'); // Nepali name
            $table->string('muni_name_en'); // English name
            $table->timestamps(); // This will add created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipalities');
    }
};
