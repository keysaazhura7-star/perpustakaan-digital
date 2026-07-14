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
        // 1. Membuat tabel borrowings terlebih dahulu jika belum ada
        if (!Schema::hasTable('borrowings')) {
            Schema::create('borrowings', function (Blueprint $table) {
                $table->id();
                $table->string('nama_peminjam');
                $table->string('judul_buku');
                $table->timestamps();
            });
        }

        // 2. Menambahkan kolom tanggal_kembali ke dalam tabel borrowings
        Schema::table('borrowings', function (Blueprint $table) {
            if (!Schema::hasColumn('borrowings', 'tanggal_kembali')) {
                $table->dateTime('tanggal_kembali')->nullable()->after('judul_buku');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel borrowings jika migrasi di-rollback
        Schema::dropIfExists('borrowings');
    }
};