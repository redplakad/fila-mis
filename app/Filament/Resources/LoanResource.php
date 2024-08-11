<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'hugeicons-money-remove-02';

    protected static ?string $navigationLabel = 'Kredit';
    
    protected static ?string $pluralLabel = 'Nominatif Kredit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('NOMOR_REKENING')
                        ->label('NOREK')->sortable(),
                TextColumn::make('NAMA_NASABAH')
                        ->label('NAMA DEBITUR')->sortable()->searchable(),
                TextColumn::make('KODE_KOLEK')
                        ->label('KOL')->sortable(),
                TextColumn::make('POKOK_PINJAMAN')
                        ->label('BAKIDEBET')
                        ->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.')) // Format angka menjadi Rp. 1.000.000,00
                        ->prefix('Rp. ')->sortable(),
                TextColumn::make('ALAMAT')
                        ->label('ALAMAT')
                        ->limit(50),
                TextColumn::make('TEMPAT_BEKERJA')
                        ->label('TEMPAT BEKERJA')
                        ->limit(50),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('KODE_KOLEK')
                    ->options([
                        1   => '1 - Lancar',
                        2   => '2 - Dalam Perhatian Khusus',
                        3   => '3 - Kurang Lancar',
                        4   => '4 - Diragukan',
                        5   => '5 - Macet',
                    ])
                    ->label('KOLEKTIBILITAS'),
                Tables\Filters\SelectFilter::make('AO')
                    ->label('AO')
                    ->options(function () {
                    return \App\Models\Loan::query()
                        ->distinct()
                        ->pluck('AO', 'AO')
                        ->sortKeys() // Optional: Mengurutkan opsi
                        ->toArray();
                })
                        ->searchable(),
                Tables\Filters\SelectFilter::make('KET_KD_PRD')
                    ->label('KODE PRODUK')
                    ->options(function () {
                        return \App\Models\Loan::query()
                            ->distinct()
                            ->pluck('KET_KD_PRD', 'KET_KD_PRD')
                            ->toArray();
                    }),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
                //ExportBulkAction::make()
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('NOMOR_REKENING')->heading('NO REKENING'),
                        Column::make('NO_CIF')->heading('CIF'),
                        Column::make('NAMA_NASABAH')->heading('NAMA DEBITUR'),
                        Column::make('ALAMAT')->heading('ALAMAT'),
                        Column::make('KODE_KOLEK')->heading('KOL'),
                        Column::make('JML_HRI_PKK')->heading('DURASI'),
                        Column::make('KET_KD_PRD')->heading('KET_KD_PRD'),
                        Column::make('TGL_PK')->heading('TGL CAIR'),
                        Column::make('PLAFOND_AWAL')->heading('PLAFOND'),
                        Column::make('BGA')->heading('BGA'),
                        Column::make('created_at')->heading('Creation date'),
                    ]),
                ])
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
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }

    public static function navigation(): array
    {
        return [
            Navigation\NavigationItem::make('Loan')
                ->icon('heroicon-o-user')
                ->url(static::getUrl()),
        ];
    }
}
