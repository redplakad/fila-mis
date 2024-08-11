<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'mis_deposit';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'DATADATE',
        'CAB',
        'NO_REK',
        'CIF',
        'NAMA_NASABAH',
        'ALAMAT',
        'KD_PRD',
        'KET_KD_PRD',
        'GOL',
        'NO_BILYET',
        'BGA',
        'TGL_MULAI',
        'TGL_AKHIR',
        'NILAI_EFEKTIF',
        'NILAI_NOMINAL',
        'STAT',
        'JK_WAKTU',
        'TGL_AWAL_CADANG',
        'TGL_AKH_CADANG',
        'NILAI_CADANG',
        'KD_PHK_TERKAIT',
        'KD_BYR_BGA',
        'KD_ROLL_OVER',
        'KD_NOMINAL',
        'NO_REK_NOM',
        'KD_BUNGA',
        'NO_REK_BGA',
        'TGL_RO',
        'BGA_JATEM',
        'NOMINAL_JATEM',
    ];
}

