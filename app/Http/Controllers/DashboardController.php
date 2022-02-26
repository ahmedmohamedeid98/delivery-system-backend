<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\MyTaskResource;
use App\Models\Feedback;
use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRequestTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getMyTasks()
    {
        $user_id = Auth::user()->id;
        $tasks = Task::with('feedback')->with('offers')->where('user_id', $user_id)->get();
        return $this->success('get my created tasks successfully', MyTaskResource::collection($tasks));
    }

    public function getAppliedTasks()
    {
        $user_id = Auth::user()->id;
        $taskIds =  UserRequestTask::where('user_id', $user_id)->get('task_id');
        $tasks = Task::whereIn('id', $taskIds)->with('feedback')->get();
        return $this->success('get my applied in tasks successfully', $tasks);
    }

    public function getMyFeedback()
    {
        $user_id = Auth::user()->id;
        try {
            $feedbacks = Feedback::where('reciver_id', $user_id)->get();
            return $this->success('get all your feedbacks successfully', $feedbacks);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }

    public function getFeedback(Request $request)
    {
        $user_id = $request->query('user_id');
        if (!$user_id || !User::find($user_id)) {
            return $this->failure(['invalid user id']);
        }
        try {
            $feedbacks = Feedback::where('reciver_id', $user_id)->limit(5)->get();
            return $this->success('get all user feedback successfully', $feedbacks);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }

    public function addFeedback(FeedbackRequest $request)
    {
        $sender_id = Auth::user()->id;
        $data = $request->all();


        $alreadyAddedFeedback = Feedback::find(['sender_id' => $sender_id, 'reciver_id' => $data['reciver_id'], 'task_id' => $data['task_id']]);
        if ($alreadyAddedFeedback) {
            return $this->failure(['you already add feedback for client who complete this task']);
        }

        try {
            DB::beginTransaction();
            $feedback = Feedback::create(
                [
                    'sender_id' => $sender_id,
                    'reciver_id' => +$data['reciver_id'],
                    'task_id' => +$data['task_id'],
                    'content' => $data['content'],
                    'rate' => $data['rate'],
                ]
            );
            $allFeedbacks =  Feedback::where('reciver_id', $data['reciver_id'])->get();
            $feedback_count = count($allFeedbacks);
            $rateSum = 0.0;
            $successCount = 0;
            for ($i = 0; $i < $feedback_count; $i++) {
                $rate = $allFeedbacks[$i]->rate;
                $rateSum += $rate;
                if ($rate >= 2.5) {
                    $successCount++;
                }
            }

            $totalRate = $rateSum / $feedback_count;
            $successRate = $successCount / $feedback_count * 100;

            $updateProfile = Profile::where('user_id', $data['reciver_id'])->update(
                [
                    'total_rate' => $totalRate,
                    'success_rate' => $successRate,
                ]
            );

            if ($updateProfile) {
                DB::commit();
                return $this->success('feedback added successfully!', $feedback);
            } else {
                return $this->failure(['faild to add feedback please try again!']);
            }
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }

    public function deleteTask(Request $request)
    {
        $task_id = $request->query('id');
        if (!$task_id || !Task::find($task_id)) {
            return $this->failure(['invalid task id']);
        }
        Task::find($task_id)->delete();
        return $this->success('Task deleted successfully!');
    }


    public function getTask(Request $request)
    {
        $task_id = $request->query('id');

        if (!$task_id || !Task::find($task_id)) {
            return $this->failure(['invalid task id']);
        }
        try {
            $task = Task::with('deliveryLocation', 'targetLocation')->where('id', $task_id)->get();
            return $this->success('get Task successfully', $task);
        } catch (Exception $ex) {
            return $this->failure([$ex->getMessage()]);
        }
    }

    public function completeTask(Request $request)
    {
        $task_id = $request->query('id');
        if (!$task_id || !Task::find($task_id)) {
            return $this->failure(['invalid task id']);
        }
        try {
            $task = Task::where('id', $task_id)->first();
            $total = 0;
            $amounts = [$task->paid_service, $task->paid_order, $task->paid_both];
            foreach ($amounts as $amount) {
                if ($amount != null) {
                    $total += $amount;
                }
            }

            DB::beginTransaction();
            $updateTask = Task::where('id', $task_id)->update(['task_status' => 2]);
            $user_id = Auth::user()->id;
            $profile = Profile::find($user_id);
            $profile->earning_amount += $total - ($total * 0.1);
            $profile->save();
            if ($updateTask) {
                DB::commit();
                return $this->success('Task completed successfully!');
            } else {
                return $this->failure(['failed to complete task please try again!']);
            }
        } catch (Exception $ex) {
            return $this->failure([$ex->getMessage()]);
        }
    }
}
