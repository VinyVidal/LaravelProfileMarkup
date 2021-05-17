<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentCreateRequest;
use App\Http\Requests\PostCommentDeleteRequest;
use App\Http\Requests\PostCommentUpdateRequest;
use App\Services\PostCommentService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    use ValidatesRequests;

    //private $service;

    public function __construct(PostCommentService $service)
    {
        $this->service = $service;
    }

    /**
     * Create a new post
     */
    public function store(PostCommentCreateRequest $request)
    {
        $data = $request->all();
        $return = $this->service->store($data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Comentário adicionado com sucesso!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }

    /**
     * Update post content
     */
    public function update($id, PostCommentUpdateRequest $request)
    {
        $data = $request->all();
        $return = $this->service->update($id, $data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Comentário editado com sucesso!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }

    /**
     * Remove a post
     */
    public function delete($id, PostCommentDeleteRequest $request)
    {
        $return = $this->service->delete($id);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Comentário removido com sucesso!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
}
