<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class WriteLogJob implements ShouldQueue
{
    use Queueable;
    protected $message ;
    /**
     * Create a new job instance.
     */
    public function __construct($message)
    {
        //
        $this->message = $message ;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Log::info('Job exectuced: '. $this->message);
    }
}
