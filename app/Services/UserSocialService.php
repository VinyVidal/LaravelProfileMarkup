<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\UserSocial;
use App\Entities\User;
use Laravel\Socialite\Facades\Socialite;


class UserSocialService {

    public function storeNew(\Laravel\Socialite\Two\User $socialUser)
    {
        try {
            // Creating User Model
            $user = new User;
            $user->fullName = $socialUser->name;
            $user->email = $socialUser->email;
            $user->birth = '2001-01-01';

            if($socialUser->nickname)
                $user->username = $socialUser->nickname;
            else    
                $user->generateUsername();

                
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
            return $e->getMessage();
        }
    }
    
}