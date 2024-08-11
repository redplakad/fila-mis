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
        Schema::create('mis_deposit', function (Blueprint $table) {
            $table->id();
            $table->string('DATADATE',50)->nullable();
            $table->char('CAB', 3)->nullable();
            $table->char('NO_REK', 12)->nullable();
            $table->char('CIF', 10)->nullable();
            $table->string('NAMA_NASABAH', 50)->nullable();
            $table->string('ALAMAT', 50)->nullable();
            $table->string('KD_PRD', 3)->nullable();
            $table->string('KET_KD_PRD', 50)->nullable();
            $table->char('GOL', 3)->nullable();
            $table->string('NO_BILYET', 15)->nullable();
            $table->string('BGA', 5)->nullable();
            $table->string('TGL_MULAI', 8)->nullable();
            $table->string('TGL_AKHIR', 8)->nullable();
            $table->float('NILAI_EFEKTIF', 15,2)->nullable();
            $table->float('NILAI_NOMINAL', 15,2)->nullable();
            $table->string('STAT', 5)->nullable();
            $table->string('JK_WAKTU', 2)->nullable();
            $table->string('TGL_AWAL_CADANG', 8)->nullable();
            $table->string('TGL_AKH_CADANG', 8)->nullable();
            $table->string('NILAI_CADANG', 15)->nullable();
            $table->string('KD_PHK_TERKAIT', 20)->nullable();
            $table->string('KD_BYR_BGA', 20)->nullable();
            $table->string('KD_ROLL_OVER', 20)->nullable();
            $table->string('KD_NOMINAL', 20)->nullable();
            $table->string('NO_REK_NOM', 12)->nullable();
            $table->string('KD_BUNGA', 20)->nullable();
            $table->char('NO_REK_BGA', 12)->nullable();
            $table->string('TGL_RO', 8)->nullable();
            $table->float('BGA_JATEM', 15, 2)->nullable();
            $table->float('NOMINAL_JATEM', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis_deposit');
    }
};
