<?php

namespace App\Jobs;

use App\Mail\DailySalesReportMail;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class DailySalesReportJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $start = now()->startOfDay();
        $end   = now()->endOfDay();

        $orders = Order::whereBetween('created_at', [$start, $end])->get();

        Mail::to(config('mail.admin_email'))
            ->send(new DailySalesReportMail(
                $orders->count(),
                $orders->sum('total'),
                now()->toDateString()
            ));
    }

}
