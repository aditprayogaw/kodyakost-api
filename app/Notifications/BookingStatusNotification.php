<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification
{
    use Queueable;

    protected $booking;
    protected $status;

    public function __construct($booking, $status)
    {
        $this->booking = $booking;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $message = '';
        if ($this->status == 'approved') {
            $message = 'Hore! Booking kamu diterima Owner. Segera lakukan pembayaran ya!';
        } elseif ($this->status == 'rejected') {
            $message = 'Maaf, booking kamu ditolak Owner. Coba cari kamar lain ya.';
        } elseif ($this->status == 'active') { // Paid
            $message = 'Pembayaran Berhasil! Selamat datang di kos baru kamu.';
        }

        return [
            'title' => 'Update Status Booking 🔔',
            'message' => $message,
            'booking_id' => $this->booking->id,
            'status' => $this->status,
            'type' => 'booking_status'
        ];
    }
}