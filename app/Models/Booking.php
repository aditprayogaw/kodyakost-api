<?php

namespace App\Models;

use GuzzleHttp\ClientTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'start_date',
        'end_date',
        'status',
        'total_price',
        'payment_status',
        'midtrans_order_id', 
        'payment_url',       
    ];

    // Relasi ke User (Penyewa)
    public function tenant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Room (Kamar)
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    
    // Helper untuk mengambil data Kost lewat Room
    // (Booking -> Room -> Kost)
    public function kost()
    {
        return $this->hasOneThrough(Kost::class, Room::class, 'id', 'id', 'room_id', 'kost_id');
    }
}

