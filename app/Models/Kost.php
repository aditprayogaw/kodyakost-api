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
        'thumbnail',
    ];

    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute() {
        if (!$this->thumbnail) return 'https://placehold.co/600x400?text=No+Image';
        return str_starts_with($this->thumbnail, 'http') 
            ? $this->thumbnail 
            : asset('storage/' . $this->thumbnail);
    }

    // Relasi ke Review
    public function reviews()
{
    return $this->hasMany(Review::class);
    }

    // Relasi ke Wishlist
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'kost_id', 'user_id');
    }

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
