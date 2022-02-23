<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUserIdsRequest;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRequestTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    // select some user to start make interview with them
    public function select(TaskUserIdsRequest $request)
    {
        $data = $request->all();
        try {
            $offer =  UserRequestTask::find(['task_id' => $data['task_id'], 'user_id' => $data['user_id']]);
            if ($offer) {
                $offer->update(['approve_status' => 1]);
                $offer->save();
            } else {
                return $this->failure(['not exist primary key [user_id, task_id]']);
            }
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
        return $this->success('upgrading this user to the candidates for doing this task');
    }

    // get candidates for do this task
    public function candidates(Request $request)
    {
        $user_id = Auth::user()->id;
        $task_id = $request->query('task_id');
        if (!$task_id || !is_numeric($task_id) || !Task::find($task_id)) {
            return $this->failure(['please provide a valid task id']);
        }

        $task = Task::find($task_id);
        if (!$task) {
            return $this->failure(['please provide a valid task id']);
        }

        if ($task->user_id != $user_id) {
            return $this->failure(["access denied, you are not the task's owner!"]);
        }

        $candidate_offers = UserRequestTask::where('task_id', $task_id)->where('approve_status', 1)->get();
        $candidate_offers_count = count($candidate_offers);
        $candidate_details = [];
        for ($i = 0; $i < $candidate_offers_count; $i++) {
            array_push($candidate_details, new UserResource(User::find($candidate_offers[$i]->user_id)));
        }

        return $this->success('get candidates for this task successfully', $candidate_details);
    }

    public function approve(TaskUserIdsRequest $request)
    {
        $data = $request->all();
        try {
            DB::transaction(function () use ($data) {
                $offer = UserRequestTask::find(['task_id' => $data['task_id'], 'user_id' => $data['user_id']]);
                if ($offer && $offer->approve_status == 1) {
                    // 1. choose one to do the task
                    $offer->approve_status = 2;
                    $offer->save();
                    // 2. delete others
                    UserRequestTask::where('task_id', $data['task_id'])->where('approve_status', '!=', 2)->delete();
                    // 3. move task from open to inprogress
                    $task = Task::find($data['task_id']);
                    $task->task_status = 1;
                    $task->save();
                } else {
                    return $this->failure(["Failure, this user is not from candidates!"]);
                }
            });
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
        return $this->success('finally, specify successfully one user from candidates for doing this task');
    }
}
