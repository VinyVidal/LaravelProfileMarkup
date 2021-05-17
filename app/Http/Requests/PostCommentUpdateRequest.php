<?php

namespace App\Http\Requests;

use App\Entities\PostComment;
use Illuminate\Foundation\Http\FormRequest;

class PostCommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = PostComment::find($this->route('id'));
        return $comment->user_id === $this->user()->id;
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
            'post_id'=> 'required|integer|exists:posts,id',
            'user_id'=> 'required|integer|exists:users,id'
        ];
    }
}
