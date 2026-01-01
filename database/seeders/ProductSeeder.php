<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // ১. হিমসাগর
    \App\Models\Product::create([
        'name' => 'Himsagar Premium',
        'price' => 120,
        'image' => 'images/Himsagaor.png', // public ফোল্ডারের ছবির পথ
        'category' => 'premium',
        'description' => 'রাজশাহীর বিখ্যাত হিমসাগর আম। ১০০% ফরমালিন মুক্ত।'
    ]);

    // ২. ল্যাংড়া
    \App\Models\Product::create([
        'name' => 'Langra (Rajshahi)',
        'price' => 110,
        'image' => 'images/langra.jpg',
        'category' => 'regular',
        'description' => 'ল্যাংড়া আম তার পাতলা ত্বক এবং অদ্ভুত সুন্দর স্বাদের জন্য পরিচিত।'
    ]);

    // ৩. আম্রপালি
    \App\Models\Product::create([
        'name' => 'Amrapali',
        'price' => 90,
        'image' => 'images/rupali.jpg',
        'category' => 'regular',
        'description' => 'আম্রপালি আম অত্যন্ত মিষ্টি এবং সুস্বাদু।'
    ]);
    
    // ৪. ফজলি
    \App\Models\Product::create([
        'name' => 'Fazli Giant',
        'price' => 80,
        'image' => 'images/Fazli-Mango.png',
        'category' => 'regular',
        'description' => 'ফজলি আম আকারে অনেক বড় হয়।'
    ]);
}
}
