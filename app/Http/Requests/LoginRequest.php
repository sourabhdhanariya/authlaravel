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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            ];
    }
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'email.required' => 'please enter email',
            'password.required' => 'please enter password',
        ];
    }

    /**
     * Get the validation attribute that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'email' => 'email address',
            'password' => 'password',
        ];
    }
}
