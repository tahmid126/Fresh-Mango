<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab; // ট্যাব ইমপোর্ট করা হলো
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // 👇 এই ফাংশনটি ট্যাব তৈরি করবে
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Users')
                ->icon('heroicon-m-user-group'),

            'admins' => Tab::make('Admins')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'admin'))
                ->icon('heroicon-m-shield-check'),

            'customers' => Tab::make('Customers')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'user'))
                ->icon('heroicon-m-users'),
        ];
    }
}