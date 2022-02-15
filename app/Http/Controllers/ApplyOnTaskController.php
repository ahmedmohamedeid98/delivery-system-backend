<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyTaskRequest;
use App\Http\Resources\TaskOfferResource;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRequestTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return response(['can_apply' => true, 'status' => 2, 'reason' => "you can apply to this task"]);
    }


    public function apply(ApplyTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $tasks = Task::where('user_id', $user_id)->where('task_id', $data['task_id'])->get();
        if ($tasks && count($tasks) > 0) {
            return $this->failure(["can not apply, you are the task's owner"]);
        }


        try {
            UserRequestTask::create([
                'user_id' => $user_id,
                'task_id' => $data['task_id'],
                'approve_status' => 0,
                'bid' => $data['bid'],
                'letter' => $data['letter'],
            ]);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }

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
