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
        Schema::create('secteur_expertises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title_hero')->nullable();
            $table->string('subtitle_hero')->nullable();
            $table->string('slug')->unique();
            $table->string('cta_label_1')->nullable();
            $table->string ('cta_url_1')->nullable();
            $table->string('cta_label_2')->nullable();
            $table->string('cta_url_2')->nullable();
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->string('icon')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('resume')->nullable();
            $table->text('description')->nullable();
            $table->boolean('mis_avant')->default(false);
            $table->integer('demande_demo')->default(0);
            $table->string('section_key')->default('secteur-expertise');
            $table->string('page_key')->default('secteur-expertise');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secteur_expertises');
    }
};
