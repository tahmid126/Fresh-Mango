<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    
    Schema::table('products', function (Blueprint $table) {
        $table->integer('commission_rate')->default(10)->after('price'); // ডিফল্ট ১০%
    });

    
    Schema::table('order_items', function (Blueprint $table) {
        $table->decimal('admin_commission', 10, 2)->default(0); //admin commission
        $table->decimal('seller_earning', 10, 2)->default(0);  //seller earning 
    });
}

    
    public function down(): void
    {
    
    }
};
