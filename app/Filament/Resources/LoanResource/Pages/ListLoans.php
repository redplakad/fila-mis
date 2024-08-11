<?php

namespace App\Filament\Resources\LoanResource\Pages;

use App\Filament\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
            ExportAction::make()->exports([
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
        ];
    }
}
