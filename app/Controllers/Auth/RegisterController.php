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
            return redirect()->back()->with('alert', $this->validation->getErrors());
        }
		
		$photo = $this->request->getFile('photo');
		$filename = $photo->getRandomName();
		$photo->move('img/photo/', $filename);
		
        $this->users->insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'photo' => $filename
        ]);
        
        $this->session->set('success', 'Registered successfully.');
        return redirect()->to(base_url());
    }
    public function __construct()
    { 
        $this->users = new User();
    }
}