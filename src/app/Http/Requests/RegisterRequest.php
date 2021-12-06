<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'lastName' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required|min:8|max:255',
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
            'name.required' => 'The :attribute is required.',
            'name.string' => 'The :attribute must be a string.',
            'name.min' => 'The :attribute must be at least 2 characters.',
            'name.max' => 'The :attribute must be less than 255 characters.',

            'lastName.required' => 'The :attribute is required.',
            'lastName.string' => 'The :attribute must be a string.',
            'lastName.min' => 'The :attribute must be at least 2 characters.',
            'lastName.max' => 'The :attribute must be less than 255 characters.',

            'email.required' => 'The :attribute is required.',
            'email.string' => 'The :attribute must be a string.',
            'email.email' => 'Type a valid :attribute.',
            'email.max' => 'The :attribute must be less than 255 characters.',
            'email.unique' => 'The :attribute is already in use.',

            'password.required' => 'The :attribute is required.',
            'password.min' => 'The :attribute must be at least 8 characters.',
            'password.max' => 'The :attribute must be less than 255 characters.',
            'password.confirmed' => 'The :attribute confirmation does not match.',

            'password_confirmation.required' => 'The :attribute is required.',
            'password_confirmation.min' => 'The :attribute must be at least 8 characters.',
            'password_confirmation.max' => 'The :attribute must be less than 255 characters.',
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
            'name' => 'name',
            'lastName' => 'last name',
            'email' => 'email address',
            'password' => 'password',
            'password_confirmation' => 'password confirmation',
        ];
    }
}
