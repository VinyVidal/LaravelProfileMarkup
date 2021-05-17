<?php

namespace App\Http\Requests;

use App\Entities\PostComment;
use Illuminate\Foundation\Http\FormRequest;

class PostCommentDeleteRequest extends FormRequest
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
