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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("title", 1000);
            $table->string("snippet");
            $table->string("document_type");
            $table->string("short", 5000);
            $table->string("source", 255);
            $table->string("category", 255)->nullable();
            $table->string("subcategory", 255)->nullable();
            $table->string("author", 255);
            $table->string("link")->unique();
            $table->dateTime("published_at");
            $table->timestamps();

            // Add an index on the published_at column
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
