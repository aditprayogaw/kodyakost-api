<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan ke database saja
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Booking Baru Masuk! 🏠',
            'message' => 'Ada penyewa baru request booking di ' . $this->booking->room->kost->name,
            'booking_id' => $this->booking->id,
            'type' => 'booking_request'
        ];
    }
}