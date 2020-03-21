<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSocialService;
use Laravel\Socialite\Facades\Socialite;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthGoogleController extends Controller
{
    private $service;

    public function __construct(UserSocialService $service)
    {
        $this->service = $service;
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $googleUser->network = 'GOOGLE';
        $existUser = User::where('email',$googleUser->email)->first();

        if($existUser) {
            // If there's already a user who signed with google before
            if($existUser->socials->where('social_network', 'google'))
            {
                // login that user
                Auth::loginUsingId($existUser->id);
                return redirect()->route('index');
            }
            // Else user already had an account but never signed up with google
            else
            {
                // Create social connection and update user data if needed
                // BETA
            }
            
        }
        else {
            // Create a new user entirely through google oauth
            $return = $this->service->storeNew($googleUser);
            Auth::loginUsingId($return['user']->id);
            return redirect()->route('index');
        }
    }
}
