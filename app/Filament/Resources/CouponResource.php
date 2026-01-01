<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket'; 

    protected static ?string $navigationLabel = 'Coupons';

    protected static ?string $navigationGroup = 'Shop Management'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('code')
                    ->required()
                    ->unique(ignoreRecord: true) 
                    ->maxLength(255)
                    ->label('Coupon Code (e.g. MANGO50)'),

               
                TextInput::make('discount_amount')
                    ->required()
                    ->numeric()
                    ->prefix('Tk')
                    ->label('Discount Amount'),

               
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true) 
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('code')
                    ->searchable()
                    ->weight('bold')
                    ->sortable(),

                TextColumn::make('discount_amount')
                    ->prefix('Tk ')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->boolean() 
                    ->label('Active'),
                
                TextColumn::make('created_at')
                    ->dateTime('d M, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                
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
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}