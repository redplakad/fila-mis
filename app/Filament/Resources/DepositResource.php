<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositResource\Pages;
use App\Filament\Resources\DepositResource\RelationManagers;
use App\Models\Deposito;
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

class DepositResource extends Resource
{
    protected static ?string $model = Deposito::class;

    protected static ?string $navigationIcon = 'hugeicons-money-bag-02';
    protected static ?string $navigationLabel = 'Deposito';
    protected static ?string $pluralLabel = 'Nominatif Deposito';

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
                TextColumn::make('NO_REK')->label('NO REKENING')
                        ->searchable()
                        ->sortable(),
                TextColumn::make('NAMA_NASABAH')->label('NAMA NASABAH')
                        ->searchable()
                        ->sortable(),
                TextColumn::make('NO_BILYET')->label('NO BILYET')
                        ->sortable(),
                TextColumn::make('BGA')->label('BGA')
                        ->getStateUsing(fn($record) => $record->BGA . ' %')
                        ->sortable(),
                TextColumn::make('TGL_MULAI')->label('TGL MULAI')
                        ->sortable(),
                TextColumn::make('TGL_AKHIR')->label('TGL AKHIR')
                        ->sortable(),
                TextColumn::make('NILAI_NOMINAL')->label('NOMINAL')
                        ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')) // Format angka menjadi Rp. 1.000.000,00
                        ->prefix('Rp. ')->sortable(),
                TextColumn::make('JK_WAKTU')->label('JW')
                        ->getStateUsing(fn($record) => $record->JK_WAKTU . ' bulan')
                        ->sortable(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('BGA')
                    ->label('BUNGA')
                    ->options(function () {
                        return \App\Models\Deposito::query()
                            ->distinct()
                            ->pluck('BGA', 'BGA')
                            ->sortKeys() // Optional: Mengurutkan opsi
                            ->toArray();
                })->searchable(),
                    
                Tables\Filters\SelectFilter::make('KET_KD_PRD')
                    ->label('KODE PRODUK')
                    ->options(function () {
                        return \App\Models\Deposito::query()
                            ->distinct()
                            ->pluck('KET_KD_PRD', 'KET_KD_PRD')
                            ->toArray();
                }),
                Tables\Filters\SelectFilter::make('KD_ROLL_OVER')
                    ->label('ROLL OVER')
                    ->options(function () {
                        return \App\Models\Deposito::query()
                            ->distinct()
                            ->pluck('KD_ROLL_OVER', 'KD_ROLL_OVER')
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
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('NO_REK')->heading('NO REKENING'),
                        Column::make('CIF')->heading('CIF'),
                        Column::make('NAMA_NASABAH')->heading('NAMA DEBITUR'),
                        Column::make('ALAMAT')->heading('ALAMAT'),
                        Column::make('KD_PRD')->heading('KD PRD'),
                        Column::make('KET_KD_PRD')->heading('PRODUK'),
                        Column::make('GOL')->heading('GOL'),
                        Column::make('NO_BILYET')->heading('BILYET'),
                        Column::make('TGL_MULAI')->heading('TGL MULAI'),
                        Column::make('TGL_AKHIR')->heading('TGL AKHIR'),
                        Column::make('NILAI_EFEKTIF')->heading('NILAI EFEKTIF'),
                        Column::make('NILAI_NOMINAL')->heading('NOMINAL'),
                        Column::make('STAT')->heading('STATUS'),
                        Column::make('JK_WAKTU')->heading('JW'),
                        Column::make('TGL_AWAL_CADANG')->heading('TGL AWAL CADANG'),
                        Column::make('TGL_AKHIR_CADANG')->heading('TGL AKHIR CADANG'),
                        Column::make('KD_PHK_TERKAIT')->heading('KD PHK TERKAIT'),
                        Column::make('KD_BYR_BGA')->heading('KD BYR BGA'),
                        Column::make('KD_ROLL_OVER')->heading('KD ROLL OVER'),
                        Column::make('KD_NOMINAL')->heading('KD NOMINAL'),
                        Column::make('NO_REK_NOM')->heading('NOREK CAIR'),
                        Column::make('KD_BUNGA')->heading('KD BUNGA'),
                        Column::make('NO_REK_BGA')->heading('NOREK CAIR BUNGA'),
                        Column::make('TGL_RO')->heading('TGL RO'),
                        Column::make('BGA_JATEM')->heading('BUNGA JATEM'),
                        Column::make('NOMINAL_JATEM')->heading('NOMINAL JATEM'),
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
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
