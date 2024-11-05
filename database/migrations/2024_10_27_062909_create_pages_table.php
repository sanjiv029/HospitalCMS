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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Page title
            $table->date('date')->nullable();// Publication date
            $table->string('slug')->unique(); // Slug for SEO-friendly URLs
            $table->text('content'); // Page content
            $table->string('img')->nullable(); // Image path or URL
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
