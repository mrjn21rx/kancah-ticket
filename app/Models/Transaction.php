<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Transaction extends Model
{
     protected $fillable = [
        'user_id',
        'event_id',
        'kode_booking',
        'jumlah_tiket',
        'total_harga',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
