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
        Schema::table('section_pages', function (Blueprint $table) {
            //
            $table->string('page_key')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('description')->nullable();
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->string('accroche_text')->nullable();
            $table->string('section_key')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('section_pages', function (Blueprint $table) {
            $table->dropColumn('page_key');
            $table->dropColumn('image');
            $table->dropColumn('title');
            $table->dropColumn('subtitle');
            $table->dropColumn('description');
            $table->dropColumn('cta_label');
            $table->dropColumn('cta_url');
            $table->dropColumn('accroche_text');
            $table->dropColumn('section_key');
            $table->dropColumn('icon');
            $table->dropColumn('icon_url');
        });
    }
};
