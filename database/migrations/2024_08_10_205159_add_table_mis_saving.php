<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mis_saving', function (Blueprint $table) {
            $table->id();
            $table->string('DATADATE',50)->nullable();
            $table->char('NO_REK', 12)->nullable();
            $table->char('CIF', 10)->nullable();
            $table->string('NAMA_NASABAH', 50)->nullable();
            $table->string('ALAMAT', 50)->nullable();
            $table->string('KD_PRD', 2)->nullable();
            $table->string('KET_KD_PRD', 50)->nullable();
            $table->string('GOL', 3)->nullable();
            $table->decimal('SALDO_EFEKTIF', 30, 2)->nullable();
            $table->string('SMP_TGL_CADANG', 8)->nullable();
            $table->float('NILAI_CADANG', 15)->nullable();
            $table->decimal('SLD_MINIMUM', 30, 2)->nullable();
            $table->decimal('SLD_TERSEDIA', 30, 2)->nullable();
            $table->decimalt('SLD_BLOKIR', 30, 2)->nullable();
            $table->string('TGL_MULAI_BLKR', 8)->nullable();
            $table->string('PHK_TERKAIT', 20)->nullable();
            $table->string('TGL_PEMBUKAAN', 8)->nullable();
            $table->string('SUKU_BGA', 5)->nullable();
            $table->string('BUNGA', 5)->nullable();
            $table->string('AO', 50)->nullable();
            $table->char('CAB_REK', 3)->nullable();
            $table->string('TGL_TUTUP', 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis_saving');
    }
};
