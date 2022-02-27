<?php

namespace App\Jobs;

use App\Http\Controllers\NotificationController;
use App\Models\Task;
use App\Models\UserRequestTask;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationToUnapprovedOffers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $task_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $offers = UserRequestTask::where('task_id', $this->task_id)->where('approve_status', '!=', 2)->get();
        foreach ($offers as $offer) {
            $task = Task::find($offer->task_id)->get('title');
            $notApproveMsg = "A task that you send offer for, " . $task->title . " has been closed or has expired. your offer has been archived!.";
            NotificationController::storeAndPublish($notApproveMsg, $offer->user_id);
            UserRequestTask::where('user_id', $offer->user_id)->where('task_id', $offer->task_id)->delete();
        }
    }
}
