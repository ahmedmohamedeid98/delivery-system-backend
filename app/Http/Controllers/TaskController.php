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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        $tasks_count = count($tasks);
        $tasks_details = [];
        for ($i = 0; $i < $tasks_count; $i++) {
            array_push($tasks_details, ['task' => new TaskResource($tasks[$i]), 'delivery_location' => DeliveryLocation::find($tasks[$i]->delivery_location_id)]);
        }
        return $this->success('success', $tasks_details);
    }

    public function create(CreateTaskRequest $request)
    {
        $task = $request->all();
        $user_id = Auth::user()->id;
        try {
            $task = Task::create([
                'user_id' => $user_id,
                'title' => $task['title'],
                'task_status' => 1, // by default open
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
