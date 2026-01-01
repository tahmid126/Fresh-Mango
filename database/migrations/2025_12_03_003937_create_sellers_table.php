<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
  public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            
            $table->string('shop_name');
            $table->string('shop_slug')->unique()->nullable(); 
            $table->string('shop_phone');
            $table->text('shop_address');
            
            $table->string('logo')->nullable(); 
            $table->string('trade_license')->nullable(); 
            
            
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
