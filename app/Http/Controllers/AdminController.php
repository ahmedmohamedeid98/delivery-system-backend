<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminTaskResource;
use App\Http\Resources\AdminUserResource;
use App\Http\Resources\ContactUsResource;
use App\Http\Resources\IdentityResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Jobs\TriggerNotification;
use App\Models\ContactUs;
use App\Models\Identity;
use App\Models\Profile;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Constraint\IsNull;

class AdminController extends Controller
{
    public function isAdmin()
    {
        if (Auth::user()->is_admin == 1) {
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

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:users',
            'password' => 'required|string|min:8',
            'secret_key' => ['required', Rule::in([env('ADMIN_PANNEL_SECRET_KEY')])],
        ]);
        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->is_admin) {
                    return $this->failure(['already registered']);
                }
                $user->is_admin = 1;
                $user->save();
                if (Hash::check($request->password, $user->password)) {
                    return $this->successWithToken($user);
                } else {
                    return $this->failure(['Invalid email or password']);
                }
            } else {
                return $this->failure(['account does not exist']);
            }
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
        return $this->successWithToken($user);
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
        $users = User::with('profile')->orderByDesc('created_at')->paginate(5);
        $data = AdminUserResource::collection($users)->response()->getData();
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

    public function verifyIdentity(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "user_id" => ['required', 'integer', function ($attr, $val, $fail) {
                if (count(User::where('id', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid');
                }
            }],
            "identity_id" => ['required', 'integer', function ($attr, $val, $fail) {
                if (count(Identity::where('id', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid');
                }
            }],
            "verify" => ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return $this->failure([$validator->errors()->all()]);
        }

        if ($data['verify'] === true) {
            DB::beginTransaction();
            $updateProfile = Profile::where('user_id', $data['user_id'])->update(['identity_status' => true]);
            $updateIdentity = Identity::where('id', $data['identity_id'])->update(['verified' => true]);
            if ($updateProfile && $updateIdentity) {
                DB::commit();
                $notifyMsg = 'Congratulations, your identities verified successfully';
                $this->dispatch(new TriggerNotification($notifyMsg, $data['user_id']));
                return $this->success('verify identity successfully!');
            }
        } else {
            DB::beginTransaction();
            $updated = User::where('id', $data['user_id'])->update(['identity_id' => null]);
            $deleted = Identity::where('id', $data['identity_id'])->delete();
            if ($deleted && $updated) {
                DB::commit();
                $notifyMsg = 'Your identity was rejected, please provide valid identity and try again.';
                $this->dispatch(new TriggerNotification($notifyMsg, $data['user_id']));
                return $this->success('rejected identity successfully!', ['rejected' => $deleted]);
            }
            return $this->failure(['failed to verify identity']);
        }
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
            'user_id' => ['required', 'integer', function ($attr, $val, $fail) {
                if (count(User::where('id', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid');
                }
            }],
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

    public function statistics()
    {
        $tasks = Task::select('task_status', DB::raw('count(*) as total'))->groupBy('task_status')->get();
        $user_count = User::count();
        $users = Profile::select('identity_status', DB::raw('count(*) as total'))->groupBy('identity_status')->get();
        $transactions = Transaction::sum('trans_amount');
        return $this->success('get statistics data successfully', [
            "tasks" => $tasks,
            "user_count" => $user_count,
            "users" => $users,
            "transactions" => $transactions,
        ]);
    }
}
