<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

// --- TAMBAHAN IMPORT PENTING (Agar Error Hilang) ---
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;     // <-- Ini yang kurang tadi
use Filament\Forms\Components\TextInput;  // <-- Ini yang kurang tadi
use Filament\Forms\Components\Textarea;   // <-- Ini yang kurang tadi
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
// ---------------------------------------------------

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // KOTAK 1: Info Utama Order
                Section::make('Order Information')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Customer')
                            ->disabled(), // Admin gak boleh ubah pembeli sembarangan

                        TextInput::make('total_price')
                            ->prefix('Rp')
                            ->disabled(), // Total harga otomatis hitungan sistem

                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                            ])
                            ->required(),

                        TextInput::make('method')
                            ->label('Payment Method')
                            ->disabled(),
                    ])->columns(2),

                // KOTAK 2: Alamat Pengiriman
                Section::make('Shipping Address')
                    ->schema([
                        TextInput::make('name')->label('Receiver Name'),
                        TextInput::make('number')->label('Phone'),
                        TextInput::make('email'),
                        Textarea::make('address')->columnSpanFull(),
                    ])->columns(3),

                // KOTAK 3: DAFTAR BARANG YANG DIBELI (RELASI)
                Section::make('Order Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship() // Mengambil data dari relasi items() di Model Order
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->label('Product')
                                    ->disabled(), // Hanya baca

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->disabled(),

                                TextInput::make('price')
                                    ->prefix('Rp')
                                    ->disabled(),
                            ])
                            ->addable(false) // Admin tidak boleh nambah item manual di sini
                            ->deletable(false) // Admin tidak boleh hapus item
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),

                // Nama User Pembeli
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('method')->label('Payment'),

                // Status bisa langsung diubah di tabel!
                SelectColumn::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ])
                    ->sortable(),

                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
