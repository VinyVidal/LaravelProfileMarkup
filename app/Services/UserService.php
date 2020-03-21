<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;


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
    }

    /**
     * Store user profile photo and bio into session
     * Photo will be saved in a temp directory
     */
    public function storeSignUpStep2(array $data)
    {
        $user = session()->get('user');

        if(isset($data['uploadedPhoto']))
        {
            $user->photo = Storage::disk('public')->putFile('images/temp', $data['uploadedPhoto']);
        }

        $user->fill($data);
        session()->put('user', $user);

        return [
            'success' => true,
            'message' => 'Dados salvos com sucesso'
        ];
    }

    /**
     * Create a new user using the stored data from session + username/password
     */
    public function store(array $data)
    {
        $user = session()->get('user');  
        $user->fill($data);
        $user->password = env('PW_CRYPT') ? bcrypt($user->password) : $user->password;
        if(isset($user->photo))
        {
            $filename = explode('/', $user->photo)[2];
            Storage::disk('public')->move($user->photo, 'images/'.$user->username.'/'.$filename);
            $user->photo = Storage::url($filename);
        }

        $user->save();

        session()->forget('user');

        return [
            'success' => true,
            'message' => 'Usuário criado com sucesso'
        ];
    }

    public function update(int $id, array $data){}

    public function delete(int $id){}

    /* 
    ---------------------------------
       USER AUTHENTICATION (LOGIN)
    ---------------------------------
    */

    public function auth(array $data)
    {
        if(env('PW_CRYPT'))
        {
            // Login com senha encriptada
            if(Auth::attempt($data))
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
                Auth::login($user);
                
                return ['success' => true];
                
            }
            else
            {
                return ['success' => false];
                
            }
        }
    }
}