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
        Schema::table('general_settings', function (Blueprint $table) {
            //
            $table->text('description')->nullable()->after('site_name');
            $table->text('meta_keywords')->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('meta_keywords');
            $table->string('meta_title')->nullable()->after('meta_description');
            $table->string('footer_text')->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            //
            $table->dropColumn(['description', 'meta_keywords', 'meta_description', 'meta_title', 'footer_text']);
        });
    }
};
