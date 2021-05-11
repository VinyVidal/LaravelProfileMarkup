<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ExploreController extends Controller
{
    public function index() {
        $query = User::where('id', '<>', Auth::user()->id)->orderBy('created_at', 'desc');
        if(request('search')) {
            $query->where('fullName', 'like', '%'.request('search').'%')
                ->orWhere('username', 'like', '%'.request('search').'%');
        }
        return view('explore.index', [
            'users' => $query->get()
        ]);
    }

    public function search(Request $request) {
        $query = User::orderBy('created_at', 'desc');
        
        return view('explore.index', [
            'users' => $query->get()
        ]);
    }
}
