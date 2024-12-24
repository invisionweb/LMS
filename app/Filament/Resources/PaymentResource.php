<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-rupee';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //TextInput::make('user_id')->label('User\'s ID'),
                Textarea::make('razorpay_payment_data')
                    ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT)) // Format the JSON nicely
                    ->rows(6)
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.name')->label('Course'),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('razorpay_payment_data.razorpay_payment_id')->label('Payment ID'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime()
                    ->sortable(),
                //->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
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
            'index' => Pages\ListPayments::route('/'),
            //'create' => Pages\CreatePayment::route('/create'),
            //'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (Filament::getCurrentPanel()->getId() === 'account') {
            return parent::getEloquentQuery()->where('user_id', Auth::id());
        } else {
            return parent::getEloquentQuery();
        }
    }
}
