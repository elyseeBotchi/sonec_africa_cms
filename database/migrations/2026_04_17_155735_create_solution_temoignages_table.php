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
        Schema::create('solution_temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('author_name')->nullable();
            $table->string('author_position')->nullable();
            $table->text('content')->nullable();
            $table->string('author_photo')->nullable();
            $table->string('author_photo_url')->nullable();
            $table->foreignId('solution_id')->constrained()->onDelete('cascade');   
            $table->string('section_key')->nullable();
            $table->string('page_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solution_temoignages');
    }
};
