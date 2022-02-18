<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Resources\TaskOfferResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\DeliveryLocation;
use App\Models\Profile;
use App\Models\TargetLocation;
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
        $per_page = 1;
        $page = $request->query('page') ?? 1;
        $user_id = Auth::user()->id;
        $profile = Profile::find($user_id);
        if (!$profile) {
            return $this->failure(["we need your address to find nearest tasks for you, please complete your profile"]);
        }

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
        // Return Only Open Tasks
        $tasks = Task::where('task_status', 0)->with(['deliveryLocation', 'targetLocation'])->whereHas('deliveryLocation', function ($query) use ($states, $countries, $cities) {
            // Fiter based on Deliver Location
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
        })->whereHas('targetLocation', function ($query) use ($profile) {
            // Returen Tasks nearst to user location
            return $query->where('country', $profile->country)->where('state', $profile->state)->where('city', $profile->city);
        })->where(function ($query) use ($budget_classes) {
            // Filter Task Based On Budget
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
        })->orderByDesc('created_at')->paginate(1)->withQueryString(); //paginate($per_page, ['*'], 'page', $page);
        //TaskResource::collection($tasks)->response()->getData(true)
        // return $this->success('success', ["tasks" => TaskResource::collection($tasks->items()), "paginate" => $tasks['links']]);
        // return $this->success('success', $tasks);
        $paginatorData = TaskResource::collection($tasks)->response()->getData();
        return $this->success('success', ["tasks" => $paginatorData->data, "paginate" => $paginatorData->meta]);
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

    private function getTargetLocationIds($country, $state, $city)
    {
        return TargetLocation::where("country", $country)->where("state", $state)->where('city', $city)->get('id');
    }
}
