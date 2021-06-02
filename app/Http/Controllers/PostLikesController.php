<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLikeRequest;
use App\Services\PostLikeService;
use Illuminate\Http\Request;

class PostLikesController extends Controller
{
    private $service;
    public function __construct(PostLikeService $service)
    {
        $this->service = $service;
    }
    public function like(PostLikeRequest $request) {
        $return = $this->service->store($request->all());
        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => '',
                'post_id' => $return['data']->post_id
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
    public function unlike(PostLikeRequest $request) {
        $return = $this->service->delete($request->all());
        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => '',
                'post_id' => $return['data']
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
}
