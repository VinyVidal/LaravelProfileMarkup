<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;

/**
 * User Profile Page flow Controller
 */

class ProfileController extends Controller
{
    use ValidatesRequests;
    //private $service;

    public function __construct()
    {
        //$this->service = $service;
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
}