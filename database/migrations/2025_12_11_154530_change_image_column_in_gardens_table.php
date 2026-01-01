<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::table('gardens', function (Blueprint $table) {
        // colum type poribotton jason kra 
        $table->json('image')->change(); 
    });
}
    
    public function down(): void
    {
        Schema::table('gardens', function (Blueprint $table) {
            //
        });
    }
};
