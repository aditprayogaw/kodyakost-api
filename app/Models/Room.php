<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'room_type',
        'price_per_month',
        'total_rooms',
        'available_rooms',
        'room_size',
    ];

    /**
     * Relasi: Room dimiliki oleh satu Kost [cite: 194].
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }
}
