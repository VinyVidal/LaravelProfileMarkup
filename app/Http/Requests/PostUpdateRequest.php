<?php

namespace App\Http\Requests;

use App\Constants\PostVisibilityConstant;
use Illuminate\Foundation\Http\FormRequest;
use App\Entities\Post;
use App\Rules\Constant;
use App\Rules\Media;

class PostUpdateRequest extends FormRequest
{
    protected $errorBag = 'post_update';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->errorBag = 'post_update'.$this->route('id');
        $post = Post::find($this->route('id'));
        return $post->user_id === $this->user()->id;
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
        ];
    }
}
