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
		$this->validation->run($request, 'login');
		$user = $this->user->where('email', $request['email'])->first();
		
		if($this->validation->getErrors()){
            return redirect()->back()->with('error', $this->validation->getErrors());
        }
		
        if($user) {
            if(password_verify($request['password'], $user->password)) {
                $authenticated = [
                    'auth' => [
                        'user' => $user,
                        'id' => $user->id
                    ]
                ];
				$this->session->set($authenticated);
                return redirect()->to(base_url());
            }else {
                return redirect()->back()->with('error', ['invalid' => 'Password anda salah']);
            }
        }else {
            return redirect()->back()->with('error', ['invalid' => 'Email tidak terdaftar']);
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
    public function __construct()
    { 
        $this->user = new User();
		$this->validation = \Config\Services::validation();
		$this->session = \Config\Services::session();
    }
}