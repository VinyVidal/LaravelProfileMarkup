<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Exceptions\Response;

class UserService {

    /* 
    -----------------------
       USER REGISTRATION
    -----------------------
    */

    /**
     * Store User Basic Info into session
     */
    public function storeSignUpStep1(array $data)
    {
        try {
            if(empty(session()->get('user')))
            {
                $user = new User;
            }
            else
            {
                $user = session()->get('user');
            }

            $user->fill($data);
            session()->put('user', $user);

            return [
                'success' => true,
                'message' => 'Dados salvos com sucesso'
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    /**
     * Store user profile photo and bio into session
     * Photo will be saved in a temp directory
     */
    public function storeSignUpStep2(array $data)
    {
        try {
            $user = session()->get('user');

            if(isset($data['uploadedPhoto']))
            {
                $user->photo = Storage::disk('public')->putFile('users/temp', $data['uploadedPhoto']);
            }

            $user->fill($data);
            session()->put('user', $user);

            return [
                'success' => true,
                'message' => 'Dados salvos com sucesso'
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    /**
     * Create a new user using the stored data from session + username/password
     */
    public function store(array $data)
    {
        try {
            $user = session()->get('user');  
            $user->fill($data);
            $user->password = env('PW_CRYPT') ? bcrypt($user->password) : $user->password;
            if(isset($user->photo))
            {
                $paths = explode('/', $user->photo);
                $filename = end($paths);
                Storage::disk('public')->move($user->photo, 'users/'.$user->username.'/'.$filename);
                $user->photo = Storage::url('users/'.$user->username.'/'.$filename);
            }
            else
            {
                $user->photo = asset('img/default-avatar.png');
            }

            $user->save();

            session()->forget('user');

            return [
                'success' => true,
                'message' => 'Usuário criado com sucesso',
                'data' => $user
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    /* 
    -----------------------
       USER UPDATE
    -----------------------
    */

    /**
     * Update user information
     */
    public function update(int $id, array $data)
    {
        try {
            $user = User::find($id);
            $user->fill($data); // Update bio

            // Update photo
            if(isset($data['uploadedPhoto']))
            {
                Storage::disk('public')->delete( str_replace('/storage/', '', $user->photo) );
                $user->photo = Storage::url(Storage::disk('public')->putFile('users/'.$user->username, $data['uploadedPhoto']));
            }

            // Update cover
            if(isset($data['uploadedCover']))
            {
                Storage::disk('public')->delete( str_replace('/storage/', '', $user->cover) );
                $user->cover = Storage::url(Storage::disk('public')->putFile('users/'.$user->username, $data['uploadedCover']));
            }
            
            $user->save();

            return [
                'success' => true,
                'message' => 'Dados atualizados com sucesso',
                'data' => $user
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function delete(int $id){}

    /* 
    ---------------------------------
       USER AUTHENTICATION (LOGIN)
    ---------------------------------
    */

    /**
     * Authenticate an User into the system using the given credentials
     */
    public function auth(array $data, bool $rememberUser)
    {
        try {
            if(env('PW_CRYPT'))
            {
                // Login com senha encriptada

                if(Auth::attempt($data, $rememberUser))
                {
                    return ['success' => true];
                }
                else
                {
                    return ['success' => false];
                }
            }
            else
            {
                // Login com senha normal
                $user = new User;
                foreach($data as $col => $val)
                {
                    if($user)
                        $user = $user->where($col, $val);
                }
                $user = $user->first();
                if($user)
                {
                    Auth::login($user, $rememberUser);
                    
                    return ['success' => true];
                    
                }
                else
                {
                    return ['success' => false];
                    
                }
            }
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    /**
     * Clear User session
     */
    public function logout()
    {
        try {
            if(Auth::check())
            {
                // Do anything before peforming user logout
                
                Auth::logout();

                return [
                    'success' => true,
                    'message' => 'logout'
                ];
            }
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}