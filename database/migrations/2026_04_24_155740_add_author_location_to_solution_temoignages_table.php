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
        Schema::table('solution_temoignages', function (Blueprint $table) {
            //
            $table->string('author_location')->nullable()->after('author_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solution_temoignages', function (Blueprint $table) {
            //
            $table->dropColumn('author_location');
        });
    }
};
