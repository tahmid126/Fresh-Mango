<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\WithdrawalResource\Pages;
use App\Models\Withdrawal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Withdraw Money';

    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default(Auth::id()),

                TextInput::make('amount')
                    ->label('Amount to Withdraw')
                    ->numeric()
                    ->prefix('Tk')
                    ->required(),

                Select::make('payment_method')
                    ->options([
                        'bKash' => 'bKash',
                        'Nagad' => 'Nagad',
                        'Bank' => 'Bank Transfer',
                    ])
                    ->required(),

                TextInput::make('account_number')
                    ->label('Account / Phone Number')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')->money('BDT')->sortable()->weight('bold'),
                TextColumn::make('payment_method'),
                TextColumn::make('account_number'),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                    }),
                
                TextColumn::make('created_at')->dateTime('d M, Y'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Withdrawal $record) => $record->status === 'Pending'),
            ]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
        ];
    }
}