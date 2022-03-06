<?php

namespace App\Http\Controllers;

use App\Events\TaskEvent;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\DeliveryLocation;
use App\Models\Profile;
use App\Models\TargetLocation;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{


    public function index(Request $request)
    {
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
        $tasks = Task::where('task_status', 0)
            ->with(['deliveryLocation', 'targetLocation'])
            ->whereHas('deliveryLocation', function ($query) use ($states, $countries, $cities) {
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
                return $query->where('country', $profile->country)
                    ->where('state', $profile->state)
                    ->whereIn('city', [$profile->city, '']);
            })->where(function ($query) use ($budget_classes) {
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
            })->orderByDesc('created_at')->paginate(15);
        $paginatorData = TaskResource::collection($tasks)->response()->getData();
        return $this->success('success', ["tasks" => $paginatorData->data, "paginate" => $paginatorData->meta]);
    }

    public function create(CreateTaskRequest $request)
    {
        $task = $request->all();
        $user_id = Auth::user()->id;
        $profile = Profile::find($user_id);
        if (!$profile) {
            return $this->failure(['Please complete your profile before creating post!']);
        }
        if ($task['payment_method'] == 0 && !$profile->connects >= 2) {
            return $this->failure(['You have not enough connects to post this task!']);
        }
        $complete_code = $this->generateRandomCompleteCode();
        try {
            DB::beginTransaction();
            if ($task['payment_method'] == 0) {
                $profile->connects = $profile->connects - 2;
                $profile->save();
            }
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
                'complete_code' => $complete_code,
            ]);
            $deliveryLocation = DeliveryLocation::find($task->delivery_location_id);
            $targetLocation = TargetLocation::find($task->target_location_id);
            // Trigger task event.
            broadcast(new TaskEvent($task, $deliveryLocation, $targetLocation))->toOthers();
            DB::commit();
            return $this->success('task created successfully!', new TaskResource($task));
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }


    private function generateRandomCompleteCode()
    {
        return strval(random_int(123456, 999999));
    }

    public function getTaskDetails(Request $request)
    {
        $task_id = $request->query('id');
        if (!$task_id || !is_numeric($task_id) || !Task::find($task_id)) {
            return $this->failure(['invalid task id']);
        }

        $task = Task::where('task_status', 0)->where('id', $task_id)->with(['deliveryLocation', 'targetLocation'])->first();
        if (!$task) {
            return $this->failure(['this task can not receive new offers!']);
        }
        return $this->success('get task details successfully!', new TaskResource($task));
    }

    public function editTask(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'id' => ['required', 'integer', Rule::exists('tasks', 'id')],
            'user_id' => ['required', 'integer', Rule::in([Auth::user()->id])]
        ]);

        if ($validator->fails()) {
            return $this->failure([$validator->errors()->all()]);
        }

        if (!isset($data['note'])) {
            $data['note'] =  '';
        }

        DB::beginTransaction();
        $task = Task::find($data['id']);
        if ($task->payment_method == 1 && $data['payment_method'] == 0) {
            $profile = Profile::find($task->user_id);
            if ($profile->connects < 2) {
                return $this->failure(['have not enough connects to make this task paymend method cash']);
            } else {
                $profile->connects = $profile->connects - 2;
                $profile->save();
            }
        }
        $updated = Task::where('id', $data['id'])->update($data);
        if ($updated) {
            DB::commit();
            return $this->success('task updated successfully!');
        } else {
            return $this->failure(['something want wrong']);
        }
    }

    public function getPerson(Request $request){
        $task_id = $request->query('id');
        if (!$task_id || !Task::find($task_id)) {
            return $this->failure(['invalid task id']);
        }
        try {
            $task = Task::with('user')->where('id', $task_id)->first();
            $user=User::with('offer')->where('id' , $task->offers[0]->user_id)->first();
            $owner =$task->user->name;
            $applier = $user->name;

            $data = [['owner'=>$owner ,'applier'=> $applier]];
            return $this->success('get Owner and Applier Of that task successfully',$data);
        } catch (Exception $ex) {
            return $this->failure([$ex->getMessage()]);
        }
    }
}
