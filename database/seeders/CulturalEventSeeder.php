<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CulturalEvent;

class CulturalEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CulturalEvent::create([
            'event_name' => 'Pawai Ogoh-ogoh (Pengerupukan)',
            'event_type' => 'pawai',
            'description' => 'Penutupan jalan total di sekitar Catur Muka.',
            'latitude' => -8.67012345,
            'longitude' => 115.21234567,
            'severity' => 'high',
            'event_date' => '2026-03-20',
        ]);

        CulturalEvent::create([
            'event_name' => 'Upacara Melasti di Pantai Sanur',
            'event_type' => 'upacara_adat',
            'description' => 'Penutupan jalan menuju Pantai Sanur selama upacara berlangsung.',
            'latitude' => -8.68812345,
            'longitude' => 115.25876543,
            'severity' => 'low',
            'event_date' => '2026-04-10',
        ]);

        CulturalEvent::create([
            'event_name' => 'Penutupan Jalan untuk Perayaan Hari Raya Galungan',
            'event_type' => 'penutupan_jalan',
            'description' => 'Penutupan jalan utama di Denpasar untuk perayaan Galungan.',
            'latitude' => -8.65543210,
            'longitude' => 115.22012345,
            'severity' => 'high',
            'event_date' => '2026-06-01',
        ]);
    }
}
