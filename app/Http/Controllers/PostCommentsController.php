<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentCreateRequest;
use App\Http\Requests\PostCommentDeleteRequest;
use App\Http\Requests\PostCommentUpdateRequest;
use App\Services\PostCommentService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store($postId, PostCommentCreateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $return = $this->service->store($data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Comentário adicionado com sucesso!',
                'comment' => $return['data']
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
                'commented_post_id' => $postId
            ]);
        }
    }

    /**
     * Update post content
     */
    public function update($postId, $id, PostCommentUpdateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $return = $this->service->update($id, $data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Comentário editado com sucesso!',
                'comment' => $return['data']
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
                'comment' => $return['data']
            ]);
        }
    }

    /**
     * Remove a post
     */
    public function delete($postId, $id, PostCommentDeleteRequest $request)
    {
        $return = $this->service->delete($id);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Comentário removido com sucesso!',
                'commented_post_id' => $postId
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
                'commented_post_id' => $postId
            ]);
        }
    }

    public function ajaxEdit($postId, $id, Request $request) {
        $return = $this->service->ajaxEdit(['id' => $id]);
        if($return['success']) {
            return response()->json([
                'view' => $return['data']   
            ]);
        } else {
            return response()->json($return['message'], 500);
        }
    }
}
