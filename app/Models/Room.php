<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getImageUrlAttribute() {
        if (!$this->image) return 'https://placehold.co/400x300?text=No+Room+Image';
        return str_starts_with($this->image, 'http') 
            ? $this->image 
            : asset('storage/' . $this->image);
    }

    /**
     * Relasi: Room dimiliki oleh satu Kost.
     */
    public function kost(): BelongsTo
    {
        return $this->belongsTo(Kost::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class);
    }
}
