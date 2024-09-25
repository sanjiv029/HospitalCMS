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
            $table->unsignedBigInteger('temporary_province_id')->nullable();
            $table->unsignedBigInteger('temporary_district_id')->nullable();
            $table->unsignedBigInteger('temporary_municipality_type_id')->nullable();
            $table->unsignedBigInteger('temporary_municipality_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('temporary_province_id');
            $table->dropColumn('temporary_district_id');
            $table->dropColumn('temporary_municipality_type_id');
            $table->dropColumn('temporary_municipality_id');
        });
    }
};
