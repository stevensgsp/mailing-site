<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email'             => ['required', 'filled', 'email', 'max:100'],

            # TODO: obliga: un número, una letra mayúscula, un carácter especial
            'password'          => ['required', 'filled', 'string', 'min:8', 'max:64', 'confirmed'],

            'phone_number'      => ['present', 'integer', 'max:9999999999'],
            'cedula'            => ['present', 'string', 'max:11'],
            'birth_date'        => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'city_id'           => ['required', 'exists:' . \App\Models\City::class . ',id'],
        ];
    }
}
