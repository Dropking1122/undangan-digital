<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('attendance'); // attending, not_attending, maybe
            $table->integer('guest_count')->default(1);
            $table->text('message')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->index('invitation_id');
        });
    }
    public function down(): void { Schema::dropIfExists('rsvps'); }
};
