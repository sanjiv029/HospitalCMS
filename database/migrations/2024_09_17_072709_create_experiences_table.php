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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->foreignId('doctor_id')
                      ->constrained('doctors')
                      ->onDelete('cascade');  
            $table->string('job_title');
            $table->string('healthcare_facilities');
            $table->string('location');
            $table->string('type_of_employment');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('exp_certificates')->nullable();
            $table->text('additional_details')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
