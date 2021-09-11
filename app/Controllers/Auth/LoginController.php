<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class LoginController extends BaseController
{	
    public function showLoginForm()
    {
        return view('auth/login');
    }
    public function login()
    {
		$request = $this->request->getPost();
		
        $this->validate([ 'email' => 'required|valid_email', 'password' => 'required' ]);
		if($this->validation->getErrors()){
            return redirect()->back()->with('alert', $this->validation->getErrors());
        }
        
		$user = $this->users->where('email', $request['email'])->first();
		
        if($user) {
            if(password_verify($request['password'], $user->password)) {
                $authenticated = [
                    'auth' => [
                        'user' => $user,
                        'id' => $user->id
                    ]
                ];
				$this->session->set($authenticated);
                $this->session->set('success', 'Welcome '.$user->name.'.');
                return redirect()->to(base_url());
            }else {
                return redirect()->back()->with('alert', ['invalid' => 'These credentials do not match our records.']);
            }
        }else {
            return redirect()->back()->with('alert', ['invalid' => 'These credentials do not match our records.']);
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
    public function __construct()
    { 
        $this->users = new User();
    }
}