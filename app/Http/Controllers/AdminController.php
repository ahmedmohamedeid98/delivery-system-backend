<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function isAdmin()
    {
        if (Auth::user()->is_admin == true) {
            return $this->success("user is admin", ["is_admin" => true]);
        } else {
            return $this->success("user is not admin", ["is_admin" => false]);
        }
    }

    public function deleteTask(Request $request)
    {
        $task_id = $request->query('id');
        if (!$task_id || !Task::find($task_id)) {
            return $this->failure(['invalid task id']);
        }
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
        Task::find($task_id)->delete();
        return $this->success('task deleted successfully!');
    }
}
