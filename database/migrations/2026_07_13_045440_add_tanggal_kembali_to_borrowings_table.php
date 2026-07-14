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
        // Pastikan nama tabelnya 'borrowings' (pakai s)
        Schema::table('borrowings', function (Blueprint $table) {
            // Menambahkan kolom tanggal_kembali dengan tipe dateTime yang boleh kosong
            $table->dateTime('tanggal_kembali')->nullable()->after('judul_buku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            // Menghapus kembali kolom jika migrasi di-rollback
            $table->dropColumn('tanggal_kembali');
        });
    }
}; 