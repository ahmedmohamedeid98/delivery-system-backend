<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactUsResource;
use App\Http\Resources\IdentityResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\ContactUs;
use App\Models\Identity;
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
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
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
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
        $contactus = ContactUs::orderByDesc('created_at')->paginate(5);
        $data = ContactUsResource::collection($contactus)->response()->getData();
        return $this->success('success', ["forms" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getUsers()
    {
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
        $users = User::orderByDesc('created_at')->paginate(5);
        $data = UserResource::collection($users)->response()->getData();
        return $this->success('success', ["users" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getTransactions()
    {
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
        $transactions = Transaction::orderByDesc('created_at')->paginate(5);
        $data = TransactionResource::collection($transactions)->response()->getData();
        return $this->success('success', ["transactions" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getIdentities()
    {
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
        $identities = Identity::orderByDesc('created_at')->paginate(5);
        $data = IdentityResource::collection($identities)->response()->getData();
        return $this->success('success', ["identities" => $data->data, "paginate" => $data->meta]);
    }

    public function deleteUser(Request $request)
    {
        if (Auth::user()->is_admin == false) {
            return $this->unauthorizedFailure();
        }
        $user_id = $request->query('id');
        $res = User::where('id', $user_id)->delete();
        if (!$res) {
            return $this->failure(['invalid user id']);
        }

        return $this->success('user deleted successfully', $res);
    }
}
