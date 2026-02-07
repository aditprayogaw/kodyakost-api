<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail, 
            
            // --- [1. STATISTIK] ---
            // Ini diambil dari controller (withAvg & withCount)
            'rating' => round($this->reviews_avg_rating ?? 0, 1), // Contoh: 4.5
            'total_reviews' => $this->reviews_count ?? 0,         // Contoh: 15
            'views' => $this->views,                              // Contoh: 105
            // ----------------------------------

            'location' => [
                'address' => $this->address,
                'district' => $this->district,
                'village' => $this->village,
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude,
            ],

            'is_verified' => (bool) $this->is_verified,
            
            'owner' => [
                'name' => $this->user->name,
                'whatsapp' => $this->user->phone_whatsapp, 
                'avatar' => $this->user->avatar, // Tambahkan ini biar foto pemilik muncul
            ],

            'price_start' => $this->rooms->min('price_per_month'),
            
            'rooms' => $this->rooms->map(function ($room) {
                return [
                    'id' => $room->id,
                    'type' => $room->room_type,
                    
                    // Jika kamu pakai single image di tabel rooms:
                    'image' => $room->image,
                    
                    'price' => $room->price_per_month,
                    'available' => $room->available_rooms,
                    'total' => $room->total_rooms,
                    
                    // Status ketersediaan (True/False)
                    'is_room_available' => $room->available_rooms > 0,
                    
                    'size' => $room->room_size,
                    'facilities' => $room->facilities->map(function ($f) {
                        return [
                            'name' => $f->name, 
                            // Pastikan icon tidak null, kasih default kalau perlu
                            'icon' => $f->icon ?? 'check-circle' 
                        ];
                    }),
                ];
            }),
        ];
    }
}