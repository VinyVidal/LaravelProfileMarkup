<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

/**
 * Main Controller
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function Authorize(bool $isAdmin = false)
    // {
    //     Auth::check();
    // }

    public function index()
    {
        if(Auth::check())
        {
            return view('index', [
                'user' => Auth::user()
            ]);
        }
        else
        {
            return redirect()->route('user.login');
        }
    }
}
