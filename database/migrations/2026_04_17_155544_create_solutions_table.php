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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('resume')->nullable();
            $table->text('description')->nullable();            
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->boolean('mis_avant')->default(false);
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video')->nullable();
            $table->string('cible')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->integer('nombre_demande_demo')->default(0);
            $table->string('page_key')->nullable();
            $table->json('disponibilite')->nullable(); //web, mobile, desktop
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
