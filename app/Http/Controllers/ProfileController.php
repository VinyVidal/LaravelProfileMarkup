<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        return view('user.profile.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show page with user info
     */
    public function showAbout()
    {
        return view('user.profile.about', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show page with user friends
     */
    public function showFriends()
    {
        return view('user.profile.friends', [
            'user' => Auth::user(),
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