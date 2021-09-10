<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
	
	public $register = [
		'photo' 			=> 'uploaded[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[photo,2048]',
		'name'  			=> 'required',
		'email' 			=> 'required|is_unique[users.email]',
		'password' 			=> 'required|min_length[8]|max_length[50]',
		'password_confirm' 	=> 'matches[password]'
	];
        
	public $register_errors = [
		'photo'				=> [
			'uploaded' 	 => 'Harus ada file yang diupload',
			'mime_in' 	 => 'File Extention harus berupa jpg, jpeg, png',
			'max_size' 	 => 'Ukuran file maksimal 2 Mb'
		],
		'name' 				=> [
			'required' 	 => 'Nama Lengkap harus diisi'
		],
		'email'				=> [
			'required' 	 => 'Email harus diisi',
			'is_unique'  => 'Email sudah digunakan sebelumnya'
		],
		'password'			=> [
			'required'	 => 'Password harus diisi',
			'min_length' => 'Password minimal 8 Karakter',
			'max_length' => 'Password maksimal 50 Karakter'
		],
		'password_confirm'	=> [
            'matches' 	 => 'Konfirmasi Password tidak sesuai dengan password'
		]
	];
	
	public $login = [
		'email'  			=> 'required',
		'password' 			=> 'required'
	];
	
	public $login_errors = [
		'email'				=> [
			'required' 	 => 'Email harus diisi'
		],
		'password'			=> [
			'required'	 => 'Password harus diisi'
		]
	];
}
