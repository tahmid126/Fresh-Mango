<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GardenResource\Pages;
use App\Models\Garden;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class GardenResource extends Resource
{
    protected static ?string $model = Garden::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo'; 

    protected static ?string $navigationLabel = 'Gardens'; 

    protected static ?string $navigationGroup = 'Website Content'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('name')
                    ->label('Garden Name')
                    ->required()
                    ->maxLength(255),

            
                TextInput::make('address')
                    ->required()
                    ->maxLength(255),

                
                FileUpload::make('image')
                    ->label('Garden Images (Max: 50MB)')
                    ->image()
                    ->directory('gardens') 
                    ->multiple()        
                    ->reorderable()     
                    ->appendFiles()    
                    ->maxSize(51200)    
                    ->imageEditor()     
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->columnSpanFull()  
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              
                ImageColumn::make('image')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->label('Images'),
                
                
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),
                
                
                TextColumn::make('address')
                    ->limit(50)
                    ->icon('heroicon-m-map-pin'),
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
            'index' => Pages\ListGardens::route('/'),
            'create' => Pages\CreateGarden::route('/create'),
            'edit' => Pages\EditGarden::route('/{record}/edit'),
        ];
    }
}