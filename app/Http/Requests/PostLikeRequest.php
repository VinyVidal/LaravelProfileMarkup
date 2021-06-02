<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostLikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (int)$this->input('user_id') === Auth::user()->id;
    }

    public function all($keys = null) 
    {
        $data = parent::all($keys);
        $data['post_id'] = $this->route('postId');
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'post_id' => 'required|integer|exists:posts,id'
        ];
    }
}
