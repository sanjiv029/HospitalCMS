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
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('date_of_birth', 'date_of_birth_ad'); // Rename the column
            $table->date('date_of_birth_ad')->nullable()->change(); // Make it nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('date_of_birth_ad', 'date_of_birth'); // Reverse the rename
            $table->date('date_of_birth')->nullable(false)->change(); // Set it back to non-nullable if needed
        });
    }
};
