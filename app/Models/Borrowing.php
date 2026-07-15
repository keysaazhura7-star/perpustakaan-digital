<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{

    protected $table = 'borrowings';

    protected $fillable = [
        'nama_peminjam',
         'judul_buku',
         'tanggal_kembali',
         'cover',
    ];
    public $timestamps = false;
}
