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
        Schema::table('espacement_menus', function (Blueprint $table) {
            $table->boolean('gras')->default(false);
            $table->boolean('italique')->default(false);
            $table->string('alignement')->default('horizontal'); // vertical ou horizontal
            $table->boolean('couleur_fond_icon')->default(false); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espacement_menus', function (Blueprint $table) {
            //
            $table->dropColumn(['gras', 'italique', 'alignement', 'couleur_fond_icon']);
        });
    }
};
