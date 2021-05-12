<?php

namespace App\Http\Controllers;

use App\Entities\Post;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\UserProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Services\UserService;

/**
 * User Profile Page flow Controller
 */

class ProfileController extends Controller
{
    use ValidatesRequests;
    //private $service;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Shows user own profile page (activities page)
     */
    public function index($username = null)
    {
        $user = Auth::user();
        $visitor = false;
        if($username) {
            $exists = User::where('username', $username)->first();
            if($exists) {
                $user = $exists;
                $visitor = true;
            } else {
                return redirect(route('user.profile'));
            }
        }
        return view('user.profile.index', [
            'visitor' => $visitor,
            'user' => $user,
            'posts' => Post::activity($user)->get()
        ]);
    }

    /**
     * Show page with user info
     */
    public function showAbout($username = null)
    {
        $user = Auth::user();
        $visitor = false;
        if($username) {
            $exists = User::where('username', $username)->first();
            if($exists) {
                $user = $exists;
                $visitor = true;
            } else {
                return redirect(route('user.profile'));
            }
        }
        return view('user.profile.about', [
            'visitor' => $visitor,
            'user' => $user,
        ]);
    }

    /**
     * Show page with user friends
     */
    public function showFriends($username = null)
    {
        $user = Auth::user();
        $visitor = false;
        if($username) {
            $exists = User::where('username', $username)->first();
            if($exists) {
                $user = $exists;
                $visitor = true;
            } else {
                return redirect(route('user.profile'));
            }
        }
        return view('user.profile.friends', [
            'visitor' => $visitor,
            'user' => $user,
            'followers' => $user->followers->all(),
            'followeds' => $user->followeds->all()
        ]);
    }

    /**
     * Update user profile details
     */
    public function update(UserProfileUpdateRequest $request)
    {
        $data = $request->all();
        $return = $this->userService->update(Auth::user()->id, $data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => $return['message'],
            ]);
        }
        else
        {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
}