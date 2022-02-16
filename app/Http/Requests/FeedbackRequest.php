<?php

namespace App\Http\Requests;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reciver_id' => ['required', 'integer', function ($attr, $val, $fail) {
                if (count(User::where('id', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid');
                }
            }],
            'task_id' => ['required', 'integer', function ($attr, $val, $fail) {
                if (count(Task::where('id', $val)->where('task_status', 2)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid or task is not completed yet.');
                }
            }],
            'rate' => ['required', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'max:1000'],
        ];
    }
}
