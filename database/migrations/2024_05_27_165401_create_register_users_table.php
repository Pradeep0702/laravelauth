<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('register_users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('email',255);
            $table->string('mobile_number',11);
            $table->integer('otp')->nullable();
            $table->timestamps();
        });
    }
   
    public function down(): void
    {
        Schema::dropIfExists('register_users');
    }
};
