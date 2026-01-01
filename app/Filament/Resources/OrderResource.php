<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\User; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder; 

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Shop Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Details')
                    ->schema([
                        TextInput::make('name')->disabled(),
                        TextInput::make('phone')->disabled(),
                        Textarea::make('address')->disabled()->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Order Info')
                    ->schema([
                        Textarea::make('order_details')->disabled()->columnSpanFull(),
                        TextInput::make('total_amount')->prefix('Tk')->disabled(),
                        TextInput::make('payment_method')->disabled(),
                        
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Processing' => 'Processing',
                                'Completed' => 'Completed',
                                'Cancelled' => 'Cancelled',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('Order ID')->searchable(),
                
                TextColumn::make('name')->searchable()->label('Customer'),

                TextColumn::make('total_amount')->sortable()->suffix(' Tk')->weight('bold'),

               
                TextColumn::make('items.seller.name')
                    ->label('Sellers Involved')
                    ->badge()
                    ->color('info')
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->placeholder('Admin / No Seller'),
                
                SelectColumn::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Processing' => 'Processing',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->selectablePlaceholder(false),

                TextColumn::make('created_at')->dateTime('d M, Y h:i A')->label('Date'),
            ])
            ->defaultSort('created_at', 'desc')
            
            
            ->filters([
                SelectFilter::make('seller_id')
                    ->label('Filter by Seller')
                    ->options(function () {
                        
                        return User::where('role', 'seller')->pluck('name', 'id');
                    })
                    ->query(function (Builder $query, array $data) {
                      
                        if (!empty($data['value'])) {
                            $query->whereHas('items', function (Builder $q) use ($data) {
                                $q->where('seller_id', $data['value']);
                            });
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}