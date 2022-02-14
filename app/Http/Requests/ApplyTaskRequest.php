<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyTaskRequest extends FormRequest
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
            'task_id' => ['required', function ($attr, $val, $fail) {
                if (count(Task::where('id', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid');
                }
            }],
            'approve_status' => ['nullable', Rule::in([0, 1, 2])],
            'bid' => ['required', 'integer'],
            'letter' => ['required', 'string', 'min:100', 'max:1000']
        ];
    }
}
