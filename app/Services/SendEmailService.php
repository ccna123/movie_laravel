<?php

namespace App\Services;

use App\Jobs\SendEmailJob;
use Carbon\Carbon;

class SendEmailService
{
    public function sendMail($cus_email, $order_data)
    {
        $job = (new SendEmailJob($cus_email, $order_data))->delay(Carbon::now()->addSeconds(5));
        dispatch($job);
    }
}
