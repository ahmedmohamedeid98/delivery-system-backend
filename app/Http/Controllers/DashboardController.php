<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getMyTasks()
    {
        $user_id = Auth::user()->id;
        $tasks = Task::where('user_id', $user_id)->get();
        return $this->success('get my tasks successfully', $tasks);
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
            $feedbacks = Feedback::where('reciver_id', $user_id)->get();
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
            $feedback = Feedback::create(
                [
                    'sender_id' => $sender_id,
                    'reciver_id' => +$data['reciver_id'],
                    'task_id' => +$data['task_id'],
                    'rate' => $data['rate'],
                    'content' => $data['content'],
                ]
            );
            return $this->success('feedback added successfully!', $feedback);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }
}
