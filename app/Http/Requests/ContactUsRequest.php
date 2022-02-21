<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            "full_name" => ['required', 'string', 'max:190'],
            "email" => ['required', 'string', 'max:190'],
            "phone" => ['nullable', 'string', 'max:20'],
            "subject" => ['required', 'string'],
            "message" => ['required', 'string']
        ];
    }
}
