<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextArea;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Transaction';

    protected static ?string $modelLabel = 'Transaction';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Transaksi')
                    ->required(),
                TextInput::make('amount')
                    ->label('Jumlah Uang')
                    ->numeric()
                    ->prefix('Rp')
                    ->inputMode('decimal')
                    ->step(0.01)
                    ->minValue(0)
                    ->required()
                    ->columnSpan('sm'),
                Select::make('type')
                    ->label('Tipe Transaksi')
                    ->options([
                        'income' => 'Pendapatan',
                        'expense' => 'Pengeluaran',
                    ])
                    ->required()
                    ->live()
                    ->native(false),
                Select::make('category')
                    ->label('Kategori Transaksi')
                    ->options(function (callable $get) {
                        if ($get('type') === 'income') {
                            return [
                                'salary' => 'Gaji',
                                'side_income' => 'Pendapatan Sampingan',
                                'investment_return' => 'Hasil Investasi',
                                'donation_received' => 'Donasi Diterima',
                                'passive_income' => 'Pendapatan Pasif',
                                'unexpected_income' => 'Pendapatan Tak Terduga',
                            ];
                        }
                        return [
                            'living_expenses' => 'Kebutuhan Pokok',
                            'shopping' => 'Belanja Konsumtif',
                            'investment_expense' => 'Pengeluaran Investasi',
                            'savings' => 'Tabungan',
                            'debts' => 'Utang dan Cicilan',
                            'entertainment' => 'Hiburan dan Gaya Hidup',
                            'education' => 'Pendidikan',
                            'health' => 'Kesehatan',
                            'emergency' => 'Pengeluaran Darurat',
                            'donation_given' => 'Donasi Diberikan',
                        ];
                    })
                    ->required()
                    ->native(false)
                    ->searchable(),
                TextArea::make('notes')
                    ->label('Catatan')
                    ->nullable(),
                DatePicker::make('date')
                    ->label('Tanggal Transaksi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Transaksi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Jumlah Uang')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe Transaksi')
                    ->state(function ($record): string {
                        return match ($record->type) {
                            'income' => 'Pendapatan',
                            'expense' => 'Pengeluaran',
                            default => $record->type,
                        };
                    })
                    ->colors([
                        'success' => fn ($state): bool => $state === 'Pendapatan',
                        'danger' => fn ($state): bool => $state === 'Pengeluaran',
                    ]),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('notes')
                    ->label('Catatan')
                    ->limit(30)
                    ->tooltip(function ($state) {
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),
                TextColumn::make('date')
                    ->label('Tanggal Transaksi')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type') // Filter by type
                    ->label('Tipe Transaksi')
                    ->options([
                        'income' => 'Pendapatan',
                        'expense' => 'Pengeluaran',
                    ]),
                Tables\Filters\SelectFilter::make('category') // Filter by category
                    ->label('Kategori')
                    ->multiple()
                    ->options([
                        'salary' => 'Gaji',
                        'side_income' => 'Pendapatan Sampingan',
                        'investment_return' => 'Hasil Investasi',
                        'donation_received' => 'Donasi Diterima',
                        'passive_income' => 'Pendapatan Pasif',
                        'unexpected_income' => 'Pendapatan Tak Terduga',
                        'living_expenses' => 'Kebutuhan Pokok',
                        'shopping' => 'Belanja Konsumtif',
                        'investment_expense' => 'Pengeluaran Investasi',
                        'savings' => 'Tabungan',
                        'debts' => 'Utang dan Cicilan',
                        'entertainment' => 'Hiburan dan Gaya Hidup',
                        'education' => 'Pendidikan',
                        'health' => 'Kesehatan',
                        'emergency' => 'Pengeluaran Darurat',
                        'donation_given' => 'Donasi Diberikan',
                    ]),
                Tables\Filters\Filter::make('date') // Filter by date
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn($query) => $query->whereDate('date', '>=', $data['date_from'])
                            )
                            ->when(
                                $data['date_until'],
                                fn($query) => $query->whereDate('date', '<=', $data['date_until'])
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Delete the selected records
                    ExportBulkAction::make() // Export the selected records
                        ->label('Export')
                        ->exports([
                            ExcelExport::make()
                                # ->queue()->withChunkSize(250) // Queue the export job and set the chunk size
                                ->fromTable()
                                ->withColumns([
                                    Column::make('title')->heading('Judul Transaksi'),
                                    Column::make('amount')->heading('Jumlah Uang')->format('Rp #,##0.00'),
                                    Column::make('type')->heading('Tipe Transaksi'),
                                    Column::make('category')->heading('Kategori'),
                                    Column::make('notes')->heading('Catatan'),
                                    Column::make('date')->heading('Tanggal Transaksi'),
                                ])
                                ->askForFilename('Transaksi-' . now()->format('d-m-Y'))
                                ->askForWriterType(),
                        ]),
                ]),
            ])
            ->headerActions([
                //
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
