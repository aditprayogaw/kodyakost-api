<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'user_id',
        'rating',
        'comment',
    ];

    // Relasi: Review ini ditulis oleh siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Review ini untuk kos mana?
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}
