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
        Schema::create('secteur_expertise_partenaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('secteur_expertise_id');
            $table->foreign('secteur_expertise_id')->references('id')->on('secteur_expertises')->onDelete('cascade');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('secteur_expertise_partenaires');
    }
};
