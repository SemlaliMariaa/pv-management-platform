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
        Schema::create('meeting_users', function (Blueprint $table) {
           $table->id();
    $table->string('fullname');
    $table->string('role');
    $table->string('signature')->nullable();
    $table->string('association_name'); 
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    
    // Index pour améliorer les performances
    $table->index('association_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_users');
    }
};
