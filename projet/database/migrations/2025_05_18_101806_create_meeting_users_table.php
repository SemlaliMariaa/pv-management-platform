<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_users', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mahdar_id')->constrained('mahdars')->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('role');
        $table->string('signature')->nullable();
        $table->timestamps();
        
        $table->index(['mahdar_id', 'user_id']);
    });
}

    public function down(): void
    {
        Schema::dropIfExists('meeting_users');
    }
};