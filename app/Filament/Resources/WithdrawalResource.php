<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawalResource\Pages;
use App\Models\Withdrawal;
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
use Filament\Forms\Components\Section;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-bangladeshi'; 

    protected static ?string $navigationGroup = 'Finance'; 

    protected static ?string $navigationLabel = 'Withdrawal Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Request Details')
                    ->schema([
                        
                        TextInput::make('user.name')
                            ->label('Seller Name')
                            ->disabled(),

                        
                        TextInput::make('amount')
                            ->prefix('Tk')
                            ->disabled(),

                        TextInput::make('payment_method')
                            ->disabled(),

            
                        TextInput::make('account_number')
                            ->disabled(),
                    ])->columns(2),

                Section::make('Admin Action')
                    ->schema([
                        
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Approved' => 'Approved (Paid)',
                                'Rejected' => 'Rejected',
                            ])
                            ->required()
                            ->native(false),

                       
                        Textarea::make('note')
                            ->label('Admin Note / Transaction ID')
                            ->placeholder('Enter TrxID if paid...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Seller')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('amount')
                    ->money('BDT')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

                TextColumn::make('payment_method')
                    ->badge(),

                TextColumn::make('account_number')
                    ->copyable(), 

               
                SelectColumn::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                    ])
                    ->selectablePlaceholder(false),

                TextColumn::make('created_at')
                    ->dateTime('d M, Y h:i A')
                    ->label('Request Date')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') 
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
            'index' => Pages\ListWithdrawals::route('/'),
            
            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
        ];
    }
}