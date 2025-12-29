<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailySalesReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public int $totalOrders,
        public float $totalRevenue,
        public string $date
    ) {}

    public function build()
    {
        return $this->subject('Daily Sales Report - ' . $this->date)
            ->view('emails.daily-sales-report');
    }
}
