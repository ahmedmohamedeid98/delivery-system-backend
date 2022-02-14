<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
}
