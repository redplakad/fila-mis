<?php

namespace App\Filament\Resources\SavingResource\Pages;

use App\Filament\Resources\SavingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ListSavings extends ListRecords
{
    protected static string $resource = SavingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
            ExportAction::make()->exports([
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
        ];
    }
}
