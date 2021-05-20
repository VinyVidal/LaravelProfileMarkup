<?php

namespace App\Http\Requests;

use App\Entities\PostComment;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PostCommentUpdateRequest extends FormRequest
{
    protected $errorBag = 'post_comment_update';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->errorBag = 'post_comment_update'.$this->route('id');
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
        ];
    }

    public function all($keys = null) 
    {
        $data = parent::all($keys);
        $data['post_id'] = $this->route('postId');
        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        session()->flash('comment_id', $this->route('id'));
        session()->flash('commented_post_id', $this->route('postId'));
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }
}
