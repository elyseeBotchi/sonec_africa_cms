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
        Schema::create('bureau_pays', function (Blueprint $table) {
            $table->id();
            $table->string('pays')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('code_pays')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('representant')->nullable();
            $table->string('maps_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bureau_pays');
    }
};
