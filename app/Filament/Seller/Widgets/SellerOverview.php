<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class SellerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // লগিন করা সেলারের আইডি নেওয়া
        $sellerId = Auth::id();

        return [
            // ১. মোট প্রোডাক্ট
            Stat::make('Total Products', Product::where('seller_id', $sellerId)->count())
                ->description('All uploaded products')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('primary'),

            // ২. পেন্ডিং প্রোডাক্ট (অপেক্ষমাণ)
            Stat::make('Pending Approval', Product::where('seller_id', $sellerId)->where('is_approved', false)->count())
                ->description('Waiting for admin review')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'), // হলুদ রঙ

            // ৩. লাইভ প্রোডাক্ট (ওয়েবসাইটে দেখাচ্ছে)
            Stat::make('Live Products', Product::where('seller_id', $sellerId)->where('is_approved', true)->count())
                ->description('Visible to customers')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'), // সবুজ রঙ
        ];
    }
}