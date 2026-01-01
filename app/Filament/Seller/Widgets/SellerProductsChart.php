<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class SellerProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Weekly Product Uploads';
    
    protected int | string | array $columnSpan = 'full';
    
    // উইজেটের উচ্চতা ঠিক করা
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::query(Product::where('seller_id', Auth::id()))
            ->between(
                start: now()->subDays(7),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Products Uploaded',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#ff9f1c', // বার এর রঙ (ম্যাংগো অরেঞ্জ)
                    'borderColor' => 'transparent',
                    'borderRadius' => 8, // বার এর মাথা গোল হবে
                    'barThickness' => 40, // বার এর চওড়া
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // লাইন চার্ট বদলে বার চার্ট করা হলো
    }
}