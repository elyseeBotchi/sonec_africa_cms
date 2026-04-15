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
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->string('position_auteur')->nullable();
            $table->string('photo_auteur')->nullable();
            $table->string('photo_auteur_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->dropColumn(['position_auteur','photo_auteur','photo_auteur_url']);
        });
    }
};
