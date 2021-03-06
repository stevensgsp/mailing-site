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
        return auth()->user()->isAdmin();
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
            'password'          => ['nullable', 'string', 'min:8', 'max:64', 'confirmed'],
            'phone_number'      => ['present', 'integer', 'max:9999999999'],
            'birth_date'        => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'city_id'           => ['required', 'exists:' . \App\Models\City::class . ',id'],
        ];
    }
}
