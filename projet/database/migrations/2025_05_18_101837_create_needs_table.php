<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
   Schema::create('needs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mahdar_id')->constrained('mahdars')->onDelete('cascade');
        $table->integer('number');
        $table->string('description');
        $table->integer('quantity_required');
        $table->timestamps();
        
        $table->index('mahdar_id');
    });
    }

    public function down()
    {
        Schema::dropIfExists('needs');
    }
};