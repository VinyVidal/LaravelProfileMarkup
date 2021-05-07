<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index() {
        return view('explore.index', [
            'users' => User::orderBy('created_at', 'desc')->get()
        ]);
    }
}
