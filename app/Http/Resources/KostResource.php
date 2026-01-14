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
                'whatsapp' => $this->user->whatsapp ?? '628123456789', 
            ],
            'thumbnail' => $this->thumbnail_url,
            'price_start' => $this->rooms->min('price_per_month'),
            'rooms' => $this->rooms->map(function ($room) {
                return [
                    'type' => $room->room_type,
                    'gallery' => $room->images->pluck('image_path'),
                    'price' => $room->price_per_month,
                    'available' => $room->available_rooms,
                    // --- FITUR: STATUS KETERSEDIAAN ---
                    'is_room_available' => $room->available_rooms > 0,
                    'size' => $room->room_size,
                    'facilities' => $room->facilities->map(function ($f) {
                        return ['name' => $f->name, 'icon' => $f->icon];
                    }),
                ];
            }),
        ];
    }
}
