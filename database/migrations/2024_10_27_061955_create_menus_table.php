<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('display')->default(true); // Show or hide the menu item
            $table->unsignedBigInteger('type_id')->nullable(); // Foreign key for type
            $table->string('type'); // 'Module' or 'Page'
            $table->boolean('status')->default(true); // Active or inactive
            $table->unsignedBigInteger('parent_id')->nullable(); // For nested menus
            $table->string('external_link')->nullable(); // External link if applicable
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
