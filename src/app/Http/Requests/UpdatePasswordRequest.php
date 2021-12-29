<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => 'required|min:8|max:255',
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
            'current_password.required' => 'The :attribute is required.',
            'current_password.min' => 'The :attribute must be at least 8 characters.',
            'current_password.max' => 'The :attribute must be less than 255 characters.',

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
            'current_password' => 'current password',
            'password' => 'password',
            'password_confirmation' => 'password confirmation',
        ];
    }
}
