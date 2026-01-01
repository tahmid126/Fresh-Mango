<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'My Orders';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('items', function ($query) {
            $query->where('seller_id', Auth::id());
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Details')
                    ->schema([
                        Forms\Components\TextInput::make('id')->label('Order ID')->disabled(),
                        Forms\Components\TextInput::make('status')->disabled(),
                        Forms\Components\TextInput::make('payment_method')->disabled(),
                        Forms\Components\Textarea::make('address')->disabled()->columnSpanFull(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->sortable()->searchable(),
                
                TextColumn::make('created_at')
                    ->dateTime('d M, Y h:i A')
                    ->label('Order Date'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Processing' => 'info',
                        'Completed' => 'success',
                        'Cancelled' => 'danger',
                        default => 'gray',
                    }),

              
                TextColumn::make('items.product.name')
                    ->label('My Products')
                    ->listWithLineBreaks()
                    ->limitList(3)
                    ->getStateUsing(function (Order $record) {
                        return $record->items
                            ->where('seller_id', Auth::id())
                            ->map(function ($item) {
                                
                                $productName = $item->product ? $item->product->name : 'Product Deleted';
                                return "{$productName} (Qty: {$item->quantity})";
                            });
                    }),

                
                TextColumn::make('seller_earnings')
                    ->label('Net Earnings')
                    ->money('BDT')
                    ->getStateUsing(function (Order $record) {
                        return $record->items
                            ->where('seller_id', Auth::id())
                            ->sum('seller_earning');
                    })
                    ->color('success')
                    ->weight('bold'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(), 
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}