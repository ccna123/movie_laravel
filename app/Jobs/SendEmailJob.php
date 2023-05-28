<?php

namespace App\Jobs;

use App\Mail\OrderMovie;
use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $cus_email, $order_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cus_email, $order_data)
    {
        $this->cus_email = $cus_email;
        $this->order_data = $order_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->cus_email)->send(new OrderMovie($this->order_data));
    }
}
