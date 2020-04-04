<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSocialService;
use Laravel\Socialite\Facades\Socialite;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserCreateExtraGoogleRequest;

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
                return redirect()->route('index', [
                    'message' => 'Bem vindo novamente!',
                ]);
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
            $return = $this->service->storeTemp($googleUser); // Temporary
            // First check if user have all required information for creating it
            // Required information that may not be fetched is: Birthday
            if(!isset($googleUser->birthday))
            {
                // Redirect user to a page to enter missing data
                
                return redirect()->route('auth.google.sign-up.extra');
            }
            else
            {
                
                $return = $this->service->storeNew($googleUser);
                if($return['success'])
                {
                    Auth::loginUsingId($return['user']->id);
                    return redirect()->route('index');
                }
                else
                {
                    return redirect()->route('user.login', [
                        'message' -> $return['message']
                    ]);
                }
            }
        }
    }

    public function showSignUpExtra()
    {
        return view('user.sign-up_extra_social', [
            'route' => 'user.google.sign-up.extra.store',
        ]);
    }

    public function postSignUpExtra(UserCreateExtraGoogleRequest $request)
    {
        $data = $request->all();
        $user = session()->get('socialUser');
        // Fill extra data (manually birthday)
        $user->birthday = $data['birthday'];
        $return = $this->service->storeNew($user);
        if($return['success'])
        {
            Auth::loginUsingId($return['user']->id);
            return redirect()->route('index');
        }
        else
        {
            return redirect()->route('user.login', [
                'message' -> $return['message']
            ]);
        }
    }
}
