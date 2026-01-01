<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'All Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Section::make('Product Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Product Name'),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Tk')
                            ->label('Price (Per Kg)'),
                            
                        TextInput::make('commission_rate')
                            ->label('Admin Commission (%)')
                            ->numeric()
                            ->default(10)
                            ->suffix('%')
                            ->required(),
                    ])->columns(3),

                
                Section::make('Images & Category')
                    ->schema([
                        Select::make('category')
                            ->options([
                                'premium' => 'Premium (Export Quality)',
                                'regular' => 'Regular',
                                'green'   => 'Green Mangoes',
                            ])
                            ->required()
                            ->native(false),
                        // ...
FileUpload::make('image')
    ->image()
    ->disk('public') 
    ->directory('products')
    ->visibility('public')
    ->imageEditor() 
    ->required()
    ->columnSpanFull(),


                        
                        
                    ]),

                
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular(),
                
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('seller.name')
                    ->label('Seller')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->placeholder('Admin (Own)'),

                TextColumn::make('price')
                    ->sortable()
                    ->suffix(' Tk'),
                
                TextColumn::make('commission_rate')
                    ->label('Comm.')
                    ->suffix('%')
                    ->sortable(),

                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'premium' => 'warning',
                        'regular' => 'gray',
                        'green'   => 'success',
                        default => 'gray',
                    }),

                
                ToggleColumn::make('is_featured')
                    ->label('Best Seller?')
                    ->onColor('warning') 
                    ->offColor('gray')
                    ->sortable(),

                
                ToggleColumn::make('is_approved')
                    ->label('Approve?')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            
            ->filters([
                SelectFilter::make('is_approved')
                    ->label('Status')
                    ->options([
                        true => 'Approved',
                        false => 'Pending',
                    ]),

                SelectFilter::make('seller')
                    ->relationship('seller', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Seller'),
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