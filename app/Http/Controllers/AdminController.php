<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactUsResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\ContactUs;
use App\Models\Task;
use App\Models\Transaction;
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

    public function getContactUs()
    {
        $contactus = ContactUs::paginate(5);
        $data = ContactUsResource::collection($contactus)->response()->getData();
        return $this->success('success', ["forms" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getUsers()
    {
        $users = User::paginate(5);
        $data = UserResource::collection($users)->response()->getData();
        return $this->success('success', ["users" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getTransactions()
    {
        $transactions = Transaction::paginate(5);
        $data = TransactionResource::collection($transactions)->response()->getData();
        return $this->success('success', ["transactions" =>  $data->data, "paginate" => $data->meta]);
    }
}
