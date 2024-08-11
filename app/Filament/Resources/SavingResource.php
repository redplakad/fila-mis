<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SavingResource\Pages;
use App\Filament\Resources\SavingResource\RelationManagers;
use App\Models\Saving;
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

class SavingResource extends Resource
{
    protected static ?string $model = Saving::class;

    protected static ?string $navigationIcon = 'hugeicons-coins-01';

    protected static ?string $navigationLabel = 'Tabungan';
    
    protected static ?string $pluralLabel = 'Nominatif Tabungan';

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
                TextColumn::make('NO_REK')
                        ->label('NO REK')
                        ->sortable()
                        ->searchable(),
                TextColumn::make('NAMA_NASABAH')
                        ->label('NAMA NASABAH')
                        ->sortable()
                        ->searchable(),
                TextColumn::make('KD_PRD')->label('PRODUK')->sortable(),
                TextColumn::make('SALDO_EFEKTIF')->label('SLD EFEKTIF')
                        ->sortable()
                        ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')) // Format angka menjadi Rp. 1.000.000,00
                        ->prefix('Rp. '),
                TextColumn::make('SLD_BLOKIR')->label('SLD BLOKIR')
                        ->sortable()
                        ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')) // Format angka menjadi Rp. 1.000.000,00
                        ->prefix('Rp. '),
                TextColumn::make('SUKU_BGA')
                        ->label('BUNGA')
                        ->getStateUsing(fn($record) => $record->SUKU_BGA . ' %')
                        ->sortable(),
                TextColumn::make('AO')
                        ->label('AO')
                        ->sortable(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('SUKU_BGA')
                ->label('SUKU BUNGA')
                ->options(function () {
                    return \App\Models\Saving::query()
                        ->distinct()
                        ->pluck('SUKU_BGA', 'SUKU_BGA')
                        ->sortKeys() // Optional: Mengurutkan opsi
                        ->toArray();
                })->searchable(),
                    
                Tables\Filters\SelectFilter::make('KET_KD_PRD')
                    ->label('KODE PRODUK')
                    ->options(function () {
                        return \App\Models\Saving::query()
                            ->distinct()
                            ->pluck('KET_KD_PRD', 'KET_KD_PRD')
                            ->toArray();
                }),
                Tables\Filters\SelectFilter::make('AO')
                    ->label('UNIT KANTOR')
                    ->options(function () {
                        return \App\Models\Saving::query()
                            ->distinct()
                            ->pluck('AO', 'AO')
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
                        Column::make('NO_REK')->heading('NO REK'),
                        Column::make('CIF')->heading('CIF'),
                        Column::make('NAMA_NASABAH')->heading('NAMA NASABAH'),
                        Column::make('ALAMAT')->heading('ALAMAT'),
                        Column::make('KD_PRD')->heading('KD PRD'),
                        Column::make('KET_KD_PRD')->heading('KET KD PRD'),
                        Column::make('GOL')->heading('GOL'),
                        Column::make('SALDO_EFEKTIF')->heading('SALDO EFEKTIF'),
                        Column::make('SMP_TGL_CADANG')->heading('SMP TGL CADANG'),
                        Column::make('NILAI_CADANG')->heading('NILAI CADANG'),
                        Column::make('SLD_MINIMUM')->heading('SLD MINIMUM'),
                        Column::make('SLD_TERSEDIA')->heading('SLD TERSEDIA'),
                        Column::make('SLD_BLOKIR')->heading('SLD BLOKIR'),
                        Column::make('TGL_MULAI_BLKR')->heading('TGL MULAI BLKR'),
                        Column::make('PHK_TERKAIT')->heading('PHK TERKAIT'),
                        Column::make('TGL_PEMBUKAAN')->heading('TGL PEMBUKAAN'),
                        Column::make('SUKU_BGA')->heading('SUKU BGA'),
                        Column::make('BUNGA')->heading('BUNGA'),
                        Column::make('AO')->heading('AO'),
                        Column::make('CAB_REK')->heading('CAB REK'),
                        Column::make('TGL_TUTUP')->heading('TGL TUTUP'),                        
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
            'index' => Pages\ListSavings::route('/'),
            'create' => Pages\CreateSaving::route('/create'),
            'edit' => Pages\EditSaving::route('/{record}/edit'),
        ];
    }
}
