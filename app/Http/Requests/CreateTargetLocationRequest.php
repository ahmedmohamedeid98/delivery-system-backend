<?php

namespace App\Http\Requests;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTargetLocationRequest extends FormRequest
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
            "country" => ["required", 'string', Rule::in(['Egypt'])],
            "state" => ['required', 'string', function ($attr, $val, $fail) {
                if (count(Governorate::where('governorate_name_en', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid.');
                }
            }],
            "city" => ['nullable', 'string', function ($attr, $val, $fail) {
                if (count(City::where('city_name_en', $val)->get()) == 0 && $val != '') {
                    $fail('The ' . $attr . ' is invalid.');
                }
            }],
            "streat" => ['nullable', 'string', 'max:190'],
            "address_note" => ['nullable', 'string', 'max:255'],
        ];
    }
}
