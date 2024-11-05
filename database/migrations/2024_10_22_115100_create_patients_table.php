<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Patient name
            $table->string('gender'); // Gender of the patient
            $table->string('age'); 
            $table->string('phone_number')->unique(); // Unique phone number
            $table->string('address')->nullable(); // Address (optional)
            $table->string('email')->unique()->nullable(); // Email (optional)
            $table->text('medical_history')->nullable(); // Medical history (optional)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
