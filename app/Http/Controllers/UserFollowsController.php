<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFollowRequest;
use App\Services\UserFollowService;
use Illuminate\Http\Request;

class UserFollowsController extends Controller
{
    private $service;
    public function __construct(UserFollowService $service)
    {
        $this->service = $service;
    }
    public function follow(UserFollowRequest $request) {
        $return = $this->service->follow($request->all());
        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Agora você está seguindo '.$return['data']->followed->fullName.'!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
    public function unfollow(UserFollowRequest $request) {
        $return = $this->service->unfollow($request->all());
        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Você deixou de seguir '.$return['data']->followed->fullName.'!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
}
