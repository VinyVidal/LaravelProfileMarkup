<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentCreateRequest extends FormRequest
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
            'comment' => 'string|max:500|required',
            'post_id'=> 'required|integer|exists:posts,id'
        ];
    }

    public function all($keys = null) 
    {
        $data = parent::all($keys);
        $data['post_id'] = $this->route('postId');
        return $data;
    }
}
