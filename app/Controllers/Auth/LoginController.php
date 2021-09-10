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
		$errors = $this->validation->getErrors();
		
		if($errors){
            session()->setFlashdata('error', $errors);
            return redirect()->back();
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
				session()->setFlashdata('error', ['invalid' => 'Password anda salah']);
                return redirect()->back();
            }
        }else {
            session()->setFlashdata('error', ['invalid' => 'Email tidak terdaftar']);
            return redirect()->back();
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
