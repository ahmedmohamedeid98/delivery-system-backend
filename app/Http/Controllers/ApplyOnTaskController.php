<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyTaskRequest;
use App\Http\Resources\TaskOfferResource;
use App\Http\Resources\UserResource;
use App\Jobs\TriggerNotification;
use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRequestTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplyOnTaskController extends Controller
{
    public function canApply(Request $request)
    {
        $task_id = $request->query('task_id');
        if (!$task_id || !is_numeric($task_id)) {
            return $this->failure(['invalid task id']);
        }
        $user_id = Auth::user()->id;
        $tasks = Task::where('user_id', $user_id)->where('id', $task_id)->get();
        if ($tasks && count($tasks) > 0) {
            return response(['can_apply' => false, 'status' => 0, 'reason' => "you are the task's owner"], 200);
        }

        $requestTask = UserRequestTask::find(["user_id" => $user_id, "task_id" => $task_id]);
        if ($requestTask) {
            return response(['can_apply' => false, 'status' => 1, 'reason' => "you already applied to this task"], 200);
        }

        $connects = Profile::find($user_id)->connects;
        if (!$connects || $connects < 2) {
            return response(['can_apply' => false, 'status' => 2, 'reason' => "you not have enough connects"], 200);
        }

        return response(['can_apply' => true, 'status' => 3, 'reason' => "you can apply to this task"]);
    }


    public function apply(ApplyTaskRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = $request->all();
        $tasks = Task::where('user_id', $user_id)->where('id', $data['task_id'])->get();
        if ($tasks && count($tasks) > 0) {
            return $this->failure(["can not apply, you are the task's owner"]);
        }

        $isAlreadyApplied = UserRequestTask::find(["user_id" => $user_id, "task_id" => $data['task_id']]);
        if ($isAlreadyApplied) {
            return $this->failure(["can not apply again, you are already applied"]);
        }
        try {
            DB::transaction(function () use ($user_id, $data) {
                $profile = Profile::find($user_id);
                $profile->connects = $profile->connects - 2;
                UserRequestTask::create([
                    'user_id' => $user_id,
                    'task_id' => $data['task_id'],
                    'approve_status' => 0,
                    'bid' => $data['bid'],
                    'letter' => $data['letter'],
                ]);
                $profile->save();
            });
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
        $notifyMsg = "New offer on your task, " . $tasks[0]->title . " ,from " . $user->name . " checkout your task offers";
        $sendTo = $tasks[0]->user_id;
        $notifyJob = new TriggerNotification($notifyMsg, $sendTo);
        $this->dispatch($notifyJob);
        return $this->success('your offer is send successfully!');
    }


    public function offersOnTask(Request $request)
    {
        $user_id = Auth::user()->id;
        $task_id = $request->query('task_id');
        if (!$task_id || !is_numeric($task_id)) {
            return $this->failure(['please provide a valid task id']);
        }

        $task = Task::find($task_id);
        if (!$task) {
            return $this->failure(['please provide a valid task id']);
        }

        if ($task->user_id != $user_id) {
            return $this->failure(["access denied, you are not the task's owner!"]);
        }

        $offers = UserRequestTask::where('task_id', $task_id)->get();
        $offers_count = count($offers);
        $offer_details = [];
        for ($i = 0; $i < $offers_count; $i++) {
            array_push($offer_details, ['user' => new UserResource(User::find($offers[$i]->user_id)), 'offer' => new TaskOfferResource($offers[$i])]);
        }

        return $this->success('get offers successfully!', $offer_details);
    }
}
