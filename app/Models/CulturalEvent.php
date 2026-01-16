<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CulturalEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_type',
        'description',
        'latitude',
        'longitude',
        'severity',
        'event_date',
    ];
}
