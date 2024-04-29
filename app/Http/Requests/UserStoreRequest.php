<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        if ($this->is('signup')) {
            return [
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[A-Z])(?=.*[^A-Za-z0-9])/',
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
                ],
                'first_name' => [
                    'required',
                ],
                'last_name' => [
                    'required',
                ]
            ];
        }

        if($this->is('profileupdate'))
        {
            return [
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        }

        if ($this->is('createsubject')) {
            return [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'required',
            ];
        }
        return [];
    }

}
