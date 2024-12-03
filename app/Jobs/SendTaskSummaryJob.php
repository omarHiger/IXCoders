<?php

namespace App\Jobs;

use App\Mail\TaskSummaryMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTaskSummaryJob implements ShouldQueue
{
    use Queueable;

    protected User $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $tasks = $this->user->tasks()->get();
        Mail::to($this->user['email'])->send(new TaskSummaryMail($this->user, $tasks));
    }
}
