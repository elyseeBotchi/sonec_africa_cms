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
        // Permet de modifier les sections d'une page (ex: accueil) et de les réorganiser facilement
        Schema::create('section_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('page_key');
            $table->string('section_key');
            $table->text('content')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_pages');
    }
};
