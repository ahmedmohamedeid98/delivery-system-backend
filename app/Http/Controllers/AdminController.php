<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminTaskResource;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\IdentityResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\ContactUs;
use App\Models\Identity;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Constraint\IsNull;

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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (!$user->is_admin) {
                return $this->unauthorizedFailure();
            }
            if (Hash::check($request->password, $user->password)) {
                return $this->successWithToken($user);
            } else {
                return $this->failure(['Invalid email or password']);
            }
        } else {
            return $this->failure(['User does not exist']);
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
        $contactus = ContactUs::orderByDesc('created_at')->paginate(5);
        $data = ContactUsResource::collection($contactus)->response()->getData();
        return $this->success('success', ["forms" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getUsers()
    {
        $users = User::orderByDesc('created_at')->paginate(5);
        $data = UserResource::collection($users)->response()->getData();
        return $this->success('success', ["users" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getTransactions()
    {
        $transactions = Transaction::orderByDesc('created_at')->paginate(5);
        $data = TransactionResource::collection($transactions)->response()->getData();
        return $this->success('success', ["transactions" =>  $data->data, "paginate" => $data->meta]);
    }

    public function getIdentities()
    {
        $identities = Identity::with('user')->orderByDesc('created_at')->paginate(5);
        $data = IdentityResource::collection($identities)->response()->getData();
        return $this->success('success', ["identities" => $data->data, "paginate" => $data->meta]);
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->query('id');
        $res = User::where('id', $user_id)->delete();
        if (!$res) {
            return $this->failure(['invalid user id']);
        }

        return $this->success('user deleted successfully', $res);
    }

    public function getTasks(Request $request)
    {
        $task_status = [0, 1, 2];
        if ($request->query('task_status')) {
            $status = $request->query('task_status');
            if (is_numeric($status)) {
                $task_status = [$status];
            }
        }
        $pages = Task::whereIn('task_status', $task_status)->with(['deliveryLocation', 'targetLocation'])->orderByDesc('created_at')->paginate(15);
        $data = AdminTaskResource::collection($pages)->response()->getData();
        return $this->success('success', ['tasks' => $data->data, "paginate" => $data->meta]);
    }

    public function assignPrivilege(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'privilege' => ['required', 'integer', Rule::in([0, 1, 2, 3, 4])],
            'user_id' => ['required', 'integer', 'exists:users'],
        ]);

        if ($validator->failed()) {
            return $this->failure($validator->errors()->all());
        }

        $isUpdated = User::where('id', $data['user_id'])->update(['is_admin' => $request['privilege']]);

        if ($isUpdated) {
            return $this->success('change privilege successfully', ['updated' => $isUpdated]);
        } else {
            return $this->failure(['failed to update privilege']);
        }
    }
}
