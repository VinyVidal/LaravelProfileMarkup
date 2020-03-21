<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Name;

class UserCreateStep1Request extends FormRequest
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
            'fullName'  => 'required|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
            'email'     => 'required|email|unique:users,email',
            'birth'     => 'required|date',
        ];
    }
}
