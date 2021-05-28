<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index() {
        return view('user.config.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update data
     */
    public function update(UserUpdateRequest $request)
    {
        $data = $request->all();
        if(isset($data['newPassword'])) {
            $data['password'] = $data['newPassword'];
        }
        
        $return = $this->service->update(Auth::user()->id, $data);

        if($return['success'])
        {
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Configurações salvas com sucesso!',
            ]);
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => $return['message'],
            ]);
        }
    }
}
