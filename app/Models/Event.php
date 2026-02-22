<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Event extends Model
{
    protected $fillable = [
        'nama_event',
        'deskripsi',
        'tanggal',
        'lokasi',
        'harga',
        'kuota'
    ];

    // Relasi: 1 Event punya banyak Transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}