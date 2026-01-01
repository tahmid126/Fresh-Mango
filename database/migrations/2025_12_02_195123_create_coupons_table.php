<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('coupons', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique(); 
        $table->integer('discount_amount'); 
        $table->boolean('is_active')->default(true); //cupon calu ase ke na check krbe
        $table->timestamps();
    });
}
    
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
