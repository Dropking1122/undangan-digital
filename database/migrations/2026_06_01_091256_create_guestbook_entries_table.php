<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('guestbook_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('message');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            $table->index(['invitation_id', 'is_visible']);
        });
    }
    public function down(): void { Schema::dropIfExists('guestbook_entries'); }
};
