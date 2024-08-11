<?php

namespace App\Filament\Resources\DepositResource\Pages;

use App\Filament\Resources\DepositResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ListDeposits extends ListRecords
{
    protected static string $resource = DepositResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
            
            ExportAction::make()->exports([
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
        ];
    }
}
