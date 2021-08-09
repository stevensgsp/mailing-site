<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailMessageRequest extends FormRequest
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
            'to'      => ['required', 'filled', 'email', 'max:100'],
            'subject' => ['required', 'filled', 'string', 'max:100'],
            'body'    => ['required', 'filled', 'max:65535'],
        ];
    }
}
