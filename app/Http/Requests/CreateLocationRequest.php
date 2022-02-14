<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateLocationRequest extends FormRequest
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
            "state" => ['required', 'string', Rule::in([
                'Alexandria',
                'Aswan', 'Asyut', 'Beheira', 'Beni Suef', 'Cairo', 'Dakahlia',
                'Damietta', 'Faiyum', 'Gharbia', 'Giza', 'Ismailia', 'Kafr El-Sheikh', 'Luxor',
                'Matrouh', 'Minya', 'Monufia', 'New Valley', 'North Sinai', 'Port Said',
                'Qalyubia', 'Qena', 'Red Sea', 'Sharqia', 'Sohag', 'South Sinai', 'Suez'
            ])],
            "city" => ['required', 'string', 'max:30'],
            "streat" => ['required', 'string', 'max:190'],
            "address_note" => ['nullable', 'string', 'max:255'],
            // "longitude" => "nullable|regex:/^\d+(\.\d{1,2})?$/",
            // "latitude" => ['nullable'],
        ];
    }
}
