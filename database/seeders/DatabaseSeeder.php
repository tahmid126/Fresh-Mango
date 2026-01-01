<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // আগের ইউজার তৈরির কোড (চাইলে রাখতে পারেন, না চাইলে মুছে দিন)
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 👇 এই লাইনটি যোগ করুন (এটাই আসল)
        $this->call(ProductSeeder::class);
    }
}