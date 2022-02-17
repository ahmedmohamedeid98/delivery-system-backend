<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Resources\TaskOfferResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\DeliveryLocation;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRequestTask;
use Exception;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class TaskController extends Controller
{
    public function index(Request $request)
    {

        $countries = null;
        $states = null;
        $cities = null;
        $budget_classes = [];

        if ($request->query('state')) {
            $states = explode(',', $request->query('state'));
        }
        if ($request->query('city')) {
            $cities = explode(',', $request->query('city'));
        }
        if ($request->query('country')) {
            $countries = explode(',', $request->query('country'));
        }

        if ($request->query('budget')) {
            $budget_classes = explode(',', $request->query('budget'));
        }
        $tasks = Task::with('deliveryLocation')->whereHas('deliveryLocation', function ($query) use ($states, $countries, $cities) {
            if ($countries) {
                $query->whereIn('country', $countries);
            }
            if ($states) {
                $query->whereIn('state', $states);
            }
            if ($cities) {
                $query->whereIn('city', $cities);
            }
            return $query;
        })->where('task_status', 0)->where(function ($query) use ($budget_classes) {
            foreach ($budget_classes as $b_class) {
                if ($b_class == 'a') {
                    $query->orwhere('budget', '<', 50);
                }
                if ($b_class == 'b') {
                    $query->orWhereBetween('budget', [50, 100]);
                }
                if ($b_class == 'c') {
                    $query->orWhereBetween('budget', [100, 200]);
                }
                if ($b_class == 'd') {
                    $query->orWhere('budget', '>', 200);
                }
            }
        })->orderByDesc('created_at')->get();

        return $this->success('success', $tasks);
    }

    public function create(CreateTaskRequest $request)
    {
        $task = $request->all();
        $user_id = Auth::user()->id;
        try {
            $task = Task::create([
                'user_id' => $user_id,
                'title' => $task['title'],
                'task_status' => 0, // by default open
                'order_status' => 0, // by default not-begin
                'travel_status' => 0, // by default not-start
                'description' => $task['description'],
                'budget' => $task['budget'],
                'order_cost' => isset($task['order_cost']) ? $task['order_cost'] : 0,
                'payment_method' => $task['payment_method'],
                'required_invoice' => $task['required_invoice'],
                'note' => isset($task['note']) ? $task['note'] : '',
                'delivery_date' => $task['delivery_date'],
                'delivery_location_id' => $task['delivery_location_id'],
                'target_location_id' => $task['target_location_id'],
            ]);
            return $this->success('task created successfully!', new TaskResource($task));
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }
}
