<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\UserSocial;
use App\Entities\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class UserSocialService {

    public function storeNew(\Laravel\Socialite\Two\User $socialUser)
    {
        try {
            // Creating User Model
            $user = new User;
            $user->fullName = $socialUser->name;
            $user->email = $socialUser->email;
            $user->birth = $socialUser->birthday;

            if($socialUser->nickname)
                $user->username = $socialUser->nickname;
            else    
                $user->generateUsername();

            //Storing user photo
            $filename = Str::random(40).'.png';
            if(Storage::disk('public')->put('images/'.$user->username.'/'.$filename, file_get_contents($socialUser->avatar)))
            {
                $user->photo = Storage::url('images/'.$user->username.'/'.$filename);
            }
                
            $user->setNewPassword();


            if($user->save())
            {
                // Creating User Social Model
                $socialData = [
                    'user_id' => $user->id,
                    'social_network' => $socialUser->network,
                    'social_id' => $socialUser->id,
                    'social_email' => $socialUser->email,
                    'social_name' => $socialUser->name,
                    'social_nickname' => $socialUser->nickname,
                    'social_avatar' => $socialUser->avatar
                ];

                $userSocial = new UserSocial;
                $userSocial->fill($socialData);
                $userSocial->save();
            }


            return [
                'success' => true,
                'user' => $user,
                'userSocial' => $userSocial
            ];

            
            
        } 
        catch (Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }
    
    // Temporary stores social user data into session variable
    public function storeTemp(\Laravel\Socialite\Two\User $socialUser)
    {
        session()->put('socialUser', $socialUser);

        return [
            'success' => true,
        ];
    }

}