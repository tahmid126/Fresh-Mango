<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('shippings', function (Blueprint $table) {
        $table->id();
        $table->string('location'); //Inside/Outside Dhaka
        $table->integer('charge');  
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
