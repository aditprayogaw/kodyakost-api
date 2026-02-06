<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Command bawaan Laravel (Biarkan saja)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Bersihkan token API yang expired (Biarkan saja, ini bagus buat performa)
Schedule::command('sanctum:prune-expired')->dailyAt('02:00');

// JALANKAN ROBOT CEK BOOKING
Schedule::command('booking:check-expired')->dailyAt('00:01');