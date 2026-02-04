<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'phone_whatsapp', 
        'avatar',
        'ktp_image', 
        'is_ktp_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_ktp_verified' => 'boolean',
        ];
    }

    // Append atribut tambahan agar muncul otomatis di JSON
    protected $appends = ['avatar_url', 'ktp_url'];

    // 1. Helper URL Avatar
    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
        }
        return asset('storage/' . $this->avatar);
    }

    // 2. Helper URL KTP (PENTING BUAT OWNER)
    public function getKtpUrlAttribute()
    {
        if (!$this->ktp_image) return null;
        return asset('storage/' . $this->ktp_image);
    }

    // Kos yang disukai user ini
    public function wishlists()
    {
        return $this->belongsToMany(Kost::class, 'wishlists', 'user_id', 'kost_id');
    }
}
