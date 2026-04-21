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
        Schema::create('secteur_expertise_accroches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('secteur_expertise_id');
            $table->foreign('secteur_expertise_id')->references('id')->on('secteur_expertises')->onDelete('cascade');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('cta_label_1')->nullable();
            $table->string('cta_url_1')->nullable();
            $table->string('cta_label_2')->nullable();
            $table->string('cta_url_2')->nullable();
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
        Schema::dropIfExists('secteur_expertise_accroches');
    }
};
