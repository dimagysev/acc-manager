<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
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
            'login'         => 'required|string|max:255',
            'password'      => 'required|string',
            'service_id'    => [
                'required',
                function($attribute, $value, $fail){
                    if (!auth()->user()->services()->find($value)){
                        $fail($attribute.' is invalid.');
                    }
                }
            ]
        ];
    }
}
