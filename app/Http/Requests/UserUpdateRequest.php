<?php

namespace App\Http\Requests;

use App\Rules\PasswordExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    protected $errorBag = 'user_update';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullName'  => 'required|min:3|max:100|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'email'     => [Rule::requiredIf(Auth::user()->socials->count() === 0), 'email', 'unique:users,email,'.Auth::user()->id],
            'birth'     => 'required|date',
            'oldPassword'       => ['sometimes', 'nullable', 'required_with:newPassword', 'min:6', new PasswordExists],
            'newPassword'       => [],
            'confirmPassword'   => 'same:newPassword'
        ];
    }
}
