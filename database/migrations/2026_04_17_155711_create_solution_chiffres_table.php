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
        Schema::create('solution_chiffres', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('value')->nullable();
            $table->foreignId('solution_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('icon')->nullable();
            $table->text('icon_url')->nullable();
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
        Schema::dropIfExists('solution_chiffres');
    }
};
