<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text'; 

    protected static ?string $navigationLabel = 'Blogs'; 

    protected static ?string $navigationGroup = 'Website Content'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(), 

                
                FileUpload::make('image')
                    ->image()
                    ->directory('blogs') 
                    ->required()
                    ->columnSpanFull(),

              
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                ImageColumn::make('image')
                    ->circular(),

          
                TextColumn::make('title')
                    ->searchable()
                    ->limit(50) 
                    ->weight('bold'),

                TextColumn::make('created_at')
                    ->dateTime('d M, Y')
                    ->label('Published Date')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') 
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}