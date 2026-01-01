<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellerResource\Pages;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront'; 

    protected static ?string $navigationLabel = 'Sellers';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                Forms\Components\TextInput::make('shop_name')->disabled(),
                Forms\Components\TextInput::make('shop_phone')->disabled(),
                Forms\Components\Textarea::make('shop_address')->columnSpanFull()->disabled(),
                
                Forms\Components\FileUpload::make('trade_license')
                    ->image()
                    ->disk('public')
                    ->directory('trade_licenses')
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('shop_name')
                    ->searchable()
                    ->weight('bold')
                    ->label('Shop Name'),

                TextColumn::make('user.name')
                    ->label('Owner Name')
                    ->searchable(),

                TextColumn::make('shop_phone')
                    ->icon('heroicon-m-phone')
                    ->label('Phone'),

                ImageColumn::make('trade_license')
                    ->disk('public')
                    ->label('License'),

               
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->sortable(),

                TextColumn::make('created_at')->dateTime('d M, Y')->label('Applied Date'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
             
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
               
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Seller $record) => $record->status === 'pending') 
                    ->action(function (Seller $record) {
                        $record->update(['status' => 'approved']);
                        
                        
                        $record->user->update(['role' => 'seller']);

                        Notification::make()
                            ->title('Seller Approved Successfully!')
                            ->success()
                            ->send();
                    }),

                
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Seller $record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(function (Seller $record) {
                        $record->update(['status' => 'rejected']);
                        
                        Notification::make()
                            ->title('Seller Application Rejected.')
                            ->danger()
                            ->send();
                    }),
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
            'index' => Pages\ListSellers::route('/'),
            
            'edit' => Pages\EditSeller::route('/{record}/edit'),
        ];
    }
}