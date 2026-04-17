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
        Schema::create('offre_emplois', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('lieu')->nullable();
            $table->string('type_contrat')->nullable();
            $table->string('slug')->nullable();
            $table->string('departement')->nullable();
            $table->string('niveau_experience')->nullable();
            $table->string('salaire')->nullable();
            $table->string('email_contact')->nullable();
            $table->string('status')->default('open');
            $table->date('date_expiration')->nullable();
            $table->unsignedBigInteger('bureau_pays_id')->nullable();
            $table->foreign('bureau_pays_id')->references('id')->on('bureau_pays')->onDelete('set null');
            $table->string('page_key')->nullable();
            $table->string('section_key')->nullable();
            $table->text('missions')->nullable();
            $table->text('profil_recherche')->nullable();
            $table->text('avantages')->nullable();
            $table->string('domaine')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emplois');
    }
};
