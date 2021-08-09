<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        # TODO: solo admins
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => ['required', 'filled', 'string', 'max:100'],
            'password'          => ['required', 'filled', 'string', 'min:8', 'max:64', 'confirmed'],
            'phone_number'      => ['present', 'integer', 'max:10'],
            'birth_date'        => ['required', 'date', 'after_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'city_id'           => ['required', 'exists:' . \App\Models\City::class],
        ];
    }
}
