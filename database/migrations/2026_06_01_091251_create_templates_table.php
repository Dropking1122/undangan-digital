<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('theme_directory'); // maps to resources/views/themes/{dir}
            $table->string('status')->default('active'); // active, inactive
            $table->boolean('is_premium')->default(false);
            $table->json('default_theme_settings')->nullable();
            $table->json('default_sections')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'is_premium']);
        });
    }
    public function down(): void { Schema::dropIfExists('templates'); }
};
