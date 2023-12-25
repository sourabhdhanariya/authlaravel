<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|digits:10',
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
            'name.required' => 'please enter first name',
            'lastname.required'=>'please enter last name ',
            'email.required' => 'please enter email',
            'password.required' => 'please enter password',
            'phone'=>'please enter phone number',
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
            'name' => 'first name',
            'lastname'=>'last name',
            'email' => 'email address',
            'password' => 'password',
            'phone'=>'phone',
        ];
    }
}
