<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'mis_saving';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'DATADATE',
        'NO_REK',
        'CIF',
        'NAMA_NASABAH',
        'ALAMAT',
        'KD_PRD',
        'KET_KD_PRD',
        'GOL',
        'SALDO_EFEKTIF',
        'SMP_TGL_CADANG',
        'NILAI_CADANG',
        'SLD_MINIMUM',
        'SLD_TERSEDIA',
        'SLD_BLOKIR',
        'TGL_MULAI_BLKR',
        'PHK_TERKAIT',
        'TGL_PEMBUKAAN',
        'SUKU_BGA',
        'BUNGA',
        'AO',
        'CAB_REK',
        'TGL_TUTUP',
    ];
}

