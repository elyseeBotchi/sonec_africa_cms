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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('description_courte')->nullable();
            $table->string('author')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_article')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('page_key')->nullable();
            $table->integer('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->integer('views')->default(0);
            $table->string('temps_lecture')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('activer_partage_reseaux_sociaux')->default(false);
            $table->string('notes')->nullable();            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
