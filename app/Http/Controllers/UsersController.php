<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Http\Requests\UserCreateStep1Request;
use App\Http\Requests\UserCreateStep2Request;
use App\Http\Requests\UserCreateRequest;

/**
 * Main Controller
 */

class UsersController extends Controller
{
    use ValidatesRequests;
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    /* 
    -----------------------
       USER REGISTRATION
    -----------------------
    */

    /**
     * Shows user sign-up page/view if he/she isn't logged in
     */
    public function showSignUpStep1()
    {
        return view('user.sign-up1');
    }

    public function postSignUpStep1(UserCreateStep1Request $request)
    {
        $data = $request->all();
        $return = $this->service->storeSignUpStep1($data);

        if($return['success'])
        {
            session()->put('sign-up_step1', true);
            return redirect()->route('user.sign-up.step2');
        }
        else
        {
            return redirect()->route('user.sign-up.step1', [
                'message' => $return['message']
            ]);
        }
    }

    public function showSignUpStep2()
    {
        $photo = 'img/default-avatar.png';
        if(session()->get('user')->photo)
        {
            $photo = Storage::url(session()->get('user')->photo);
        }
        return view('user.sign-up2', [
            'photo' => asset($photo)
        ]);
    }

    public function postSignUpStep2(UserCreateStep2Request $request)
    {
        $data = $request->all();
        $return = $this->service->storeSignUpStep2($data);

        if($return['success'])
        {
            session()->put('sign-up_step2', true);
            return redirect()->route('user.sign-up.step3');
        }
        else
        {
            return redirect()->route('user.sign-up.step2', [
                'message' => $return['message']
            ]);
        }
    }

    public function showSignUpStep3()
    {
        return view('user.sign-up3');
    }

    public function postSignUpStep3(UserCreateRequest $request)
    {
        $data = $request->all();
        $return = $this->service->store($data);

        if($return['success'])
        {
            session()->put('sign-up_step3', true);
            return redirect()->route('user.index');
        }
        else
        {
            return redirect()->route('user.sign-up.step3', [
                'message' => $return['message']
            ]);
        }
    }

    /* 
    ---------------------------------
       USER AUTHENTICATION (LOGIN)
    ---------------------------------
    */

    /**
     * Shows user login page/view if he/she isn't logged in
     */
    public function showLogin()
    {
        return view('user.login'); 
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $return = $this->service->auth($credentials);

        if($return['success'])
        {
            return redirect()->route('index');
        }
        else
        {
            return redirect()->route('user.login');
        }
    }
}