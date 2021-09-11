<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\PasswordReset;
use App\Models\User;

class ResetPasswordController extends BaseController
{
    public function showLinkRequestForm()
    {
        return view('auth/password/email');
    }
    public function resetPassword($email)
    {
        if(!session('token')) throw $this->pageNotFound;
        
        $request = $this->request->getPost();
        
        $this->validate([ 'password' => 'required|min_length[8]|max_length[50]', 'password_confirm' => 'matches[password]' ]);
        if($this->validation->getErrors()){
            return redirect()->back()->with('alert', $this->validation->getErrors());
        }
        
        $user = $this->users->where('email', session('email'))->first();
        $this->users->update( $user->id,[
            'password' => password_hash($request['password'], PASSWORD_BCRYPT)
        ]);
        
        $this->passwordResets->where('email', session('email'))->delete();
        $this->session->remove(['email', 'token']);
        
        $this->session->set('success', 'Password changed successfully.');
        return redirect()->to(base_url());
    }
    public function sendResetLinkEmail()
    {
		$request = $this->request->getPost();
        
		$this->validate([ 'email' => 'required|valid_email' ]);
		if($this->validation->getErrors()){
            return redirect()->back()->with('alert', $this->validation->getErrors());
        }
        
		$user = $this->users->where('email', $request['email'])->first();
        
        if($user) {
            $this->passwordResets->where('email', $request['email'])->delete();
            
            $token = base64_encode(random_bytes(32));
            $this->passwordResets->insert([
                'email' => $request['email'],
                'token' => $token
            ]);
            
            $this->email->initialize($this->emailConfig());
            $this->email->setTo($user->email);
            $this->email->setFrom($_ENV['mail.from.address'], $_ENV['mail.from.name']);
            $this->email->setSubject('Reset Password');
            $this->email->setMessage(view('mail/password-reset',['email' => $user->email, 'token' => $token]));
            
            if($this->email->send()) {
                $this->session->set('success', 'Please check your email.');
                return redirect()->to(base_url());
            }else {
                return redirect()->back()->with('alert', $this->email->printDebugger(['headers']));
            }
        }else {
            return redirect()->back()->with('alert', ['invalid' => "We can't find a user with that e-mail address."]);
        }
    }
    public function showResetForm($email)
    {
        $data = $this->passwordResets->where(['email' => $email, 'token' => $this->request->getGet('token')])->first();
        
        if($data) {
            if(time()-strtotime($data->created_at) < (60*60*24)) {
                $this->session->set(['email' => $email, 'token' => $this->request->getGet('token')]);
                return view('auth/password/reset');
            }else {
                $data->delete();
                throw $this->pageNotFound;
            }
        }else {
            throw $this->pageNotFound;
        }
    }
    public function __construct()
    { 
        $this->users = new User();
        $this->passwordResets = new PasswordReset();
    }
}
