<?php

namespace App\Services;

use App\Mail\OrderMovie;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class SendEmailService
{
    public function sendMail($cus_email, $order_data)
    {
        Mail::to($cus_email)->send(new OrderMovie($order_data));
    }
}
