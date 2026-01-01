<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden; 

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'My Products';

   
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('seller_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Hidden::make('seller_id')
                    ->default(Auth::id()),

                
                Hidden::make('is_approved')
                    ->default(false)
                    ->dehydrated(true), 

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Product Name'),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Tk')
                    ->label('Price (Per Kg)'),

                Select::make('category')
                    ->options([
                        'premium' => 'Premium (Export Quality)',
                        'regular' => 'Regular',
                        'green'   => 'Green Mangoes',
                    ])
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->circular(),
                
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('price')
                    ->sortable()
                    ->suffix(' Tk'),

                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'premium' => 'warning',
                        'regular' => 'gray',
                        'green'   => 'success',
                    }),

                
                TextColumn::make('is_approved')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => $state ? 'Live' : 'Pending Approval')
                    ->color(fn (bool $state) => $state ? 'success' : 'warning')
                    ->icon(fn (bool $state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-clock'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}