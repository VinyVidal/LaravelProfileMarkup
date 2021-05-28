<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Services\PostService;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostDeleteRequest;
use App\Http\Requests\PostUpdateRequest;
use Exception;
use Facade\FlareClient\View;

class PostsController extends Controller
{
    use ValidatesRequests;

    private $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Show a single post
     */
    // public function index($id)
    // {
    //     $result = Post::find($id);
    // }

    /**
     * Create a new post
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->all();
        $return = $this->service->store($data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Publicado com sucesso!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'post_new_message' => $return['message'],
            ]);
        }
    }

    /**
     * Update post content
     */
    public function update($id, PostUpdateRequest $request)
    {
        $data = $request->all();
        $return = $this->service->update($id, $data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Publicação editada com sucesso!',
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
    public function delete($id, PostDeleteRequest $request)
    {
        $return = $this->service->delete($id);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Publicação removida com sucesso!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }

    public function ajaxEdit(Request $request) {
        $return = $this->service->ajaxEdit(['id' => $request->input('id')]);
        if($return['success']) {
            return response()->json([
                'view' => $return['data']   
            ]);
        } else {
            return response()->json($return['message'], 500);
        }
    }
}
