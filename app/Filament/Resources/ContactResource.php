<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right'; 

    protected static ?string $navigationLabel = 'Messages'; 

    protected static ?string $navigationGroup = 'Customer Support'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Customer Name')
                    ->disabled(),
                
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->disabled(),

              
                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->disabled(),
                
                Forms\Components\TextInput::make('subject')
                    ->disabled()
                    ->columnSpanFull(),
                
                Forms\Components\Textarea::make('message')
                    ->rows(5)
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               
                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold')
                    ->sortable(),

               
                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->searchable(),

                
                TextColumn::make('phone')
                    ->icon('heroicon-m-phone')
                    ->searchable()
                    ->label('Phone'),

                
                TextColumn::make('subject')
                    ->limit(20)
                    ->searchable(),

                
                TextColumn::make('message')
                    ->limit(30)
                    ->label('Message Preview'),

                
                TextColumn::make('created_at')
                    ->dateTime('d M, Y h:i A')
                    ->label('Received At')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') 
            ->actions([
                Tables\Actions\ViewAction::make(), 
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
            'index' => Pages\ListContacts::route('/'),
            
        ];
    }
}