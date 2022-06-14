<?php

namespace Modules\News\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\News\Emails\SendEmailNews;
use Illuminate\Support\Facades\Mail;

class SendEmailBlog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details= $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new SendEmailTest();
        Mail::to($this->details['email'])->send($email);
    }
}
