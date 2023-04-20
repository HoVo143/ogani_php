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
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(); // dc phep null
            $table->string('slug', 255)->nullable(); // dc phep null
            $table->text('description')->nullable();
            $table->string('author')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_show')->default(1);
            $table->boolean('is_approved')->nullable();
            $table->timestamps(); //created_at, updated_at
            $table->softDeletes(); // delete_at
            $table->unsignedBigInteger('article_category_id');
            $table->foreign('article_category_id')->references('id')->on('article_category');
        });

        // App\Models\Product::factory(10)->create();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};
