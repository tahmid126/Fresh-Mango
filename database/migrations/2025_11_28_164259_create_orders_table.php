<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable(); // je user order korese
        
        $table->string('name');
        $table->string('phone');
        $table->text('address');
        $table->string('city');
        
        $table->text('order_details'); 
        $table->integer('total_amount'); 
        $table->string('payment_method'); 
        $table->string('status')->default('Pending'); 
        
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
