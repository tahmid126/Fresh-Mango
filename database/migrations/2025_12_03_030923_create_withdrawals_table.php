<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('withdrawals', function (Blueprint $table) {
        $table->id();
        //kon seller request korese
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->decimal('amount', 10, 2); 
        $table->string('payment_method'); 
        $table->string('account_number'); 
        $table->string('status')->default('Pending'); 
        $table->text('note')->nullable(); 
        
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
