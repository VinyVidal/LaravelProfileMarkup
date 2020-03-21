<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(session()->get('sign-up_step1') && session()->get('sign-up_step2'))
            return true;
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'          => 'required|min:3|max:20|unique:users,username',
            'password'          => 'required|min:6',
            'confirmPassword'   => 'required|same:password'
        ];
    }
}
