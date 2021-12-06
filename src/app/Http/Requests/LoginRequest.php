<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8',
            'name' => 'required|min:3|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'The :attribute is required.',
            'email.email' => 'Type a valid :attribute.',
            'password.required' => 'The :attribute is required.',
            'password.min' => 'The :attribute must be at least 8 characters.',
            'name.required' => 'The :attribute is required.',
            'name.min' => 'The :attribute must be at least 3 characters.',
            'name.string' => 'The :attribute must be a string.',
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'email address',
            'password' => 'password',
            'name' => 'client name',
        ];
    }
}
