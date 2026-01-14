<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'district',
        'village',
        'latitude',
        'longitude',
        'is_verified',
    ];

    /**
     * Relasi: Kost dimiliki oleh satu User (Owner)
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Kost memiliki banyak tipe kamar (Rooms)
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
