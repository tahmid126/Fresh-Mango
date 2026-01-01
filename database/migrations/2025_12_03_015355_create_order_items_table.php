<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade'); // মূল অর্ডারের সাথে লিংক
        $table->foreignId('product_id')->constrained()->onDelete('cascade'); // কোন প্রোডাক্ট
        $table->foreignId('seller_id')->nullable()->constrained('users')->onDelete('cascade'); // কোন সেলারের প্রোডাক্ট
        
        $table->integer('quantity');
        $table->integer('price'); 
        $table->integer('total'); 
        
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
