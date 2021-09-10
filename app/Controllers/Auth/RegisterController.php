<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class RegisterController extends BaseController
{
    public function showRegisterForm()
    {
        return view('auth/register');
    }
    public function register()
    {
		$request = $this->request->getPost();
		$this->validation->run($request, 'register');
		
		if($this->validation->getErrors()){
            return redirect()->back()->with('error', $this->validation->getErrors());
        }
		
		$photo = $this->request->getFile('photo');
		$filename = $photo->getRandomName();
		$photo->move('img/photo/', $filename);
		
        $this->user->insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'photo' => $filename
        ]);
        
        return redirect()->to(base_url());
    }
    public function __construct()
    { 
        $this->user = new User();
		$this->validation = \Config\Services::validation();
		$this->session = \Config\Services::session();
    }
}