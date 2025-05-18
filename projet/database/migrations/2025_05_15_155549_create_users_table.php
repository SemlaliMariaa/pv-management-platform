<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('fullname');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('telephone');
        $table->string('address')->nullable();
        $table->string('name_association');
        $table->enum('role', ['admin', 'user'])->default('user');
        $table->enum('roleuser', ['رئيس(ة) الجمعية', 'كاتب(ة) الجمعية', 'أمين(ة) الجمعية', 'عضو الجمعية'])->nullable();
        $table->boolean('is_approved')->default(false);
        $table->timestamps();
    });
       
DB::table('users')->insert([
    'fullname' => 'رشيد العلوي',
    'email' => 'Rachid.Alaoui@admin.com',
    'password' => Hash::make('rachid@2025'),
    'telephone' => '0600000000',
    'address' => 'عنوان الأدمن',
    'name_association' => 'جمعية الأدمن',
    'role' => 'admin',
    'is_approved'=>true,
    'created_at' => now(),
    'updated_at' => now()
]);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};