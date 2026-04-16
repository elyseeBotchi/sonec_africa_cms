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
        Schema::table('banniere_heroes', function (Blueprint $table) {
            //
            $table->string('section_key')->nullable()->after('page_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banniere_heroes', function (Blueprint $table) {
            //
            $table->dropColumn('section_key');
        });
    }
};
