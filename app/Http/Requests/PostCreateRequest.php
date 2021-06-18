<?php

namespace App\Http\Requests;

use App\Constants\PostVisibilityConstant;
use App\Rules\Constant;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Media;

class PostCreateRequest extends FormRequest
{
    protected $errorBag = 'post_create';

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
            'text' => 'required|string|max:500',
            'uploadedMedia' => ['nullable', 'file', new Media],
            'visibility' => ['required', 'integer', new Constant(PostVisibilityConstant::class)],
            'user_id' => 'required|integer'
        ];
    }
}
