<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    protected $table = 'borrowings';
    protected $fillable = ['nama_peminjam', 'judul_buku', 'tanggal_kembali', 'cover'];
    public $timestamps = false;

    // Menghitung Denda (Accessor)
    public function getDendaAttribute()
    {
        $tenggat = Carbon::parse($this->tanggal_kembali);
        $hariIni = Carbon::now();
        return ($hariIni->gt($tenggat)) ? $hariIni->diffInDays($tenggat) * 30000 : 0;
    }
}