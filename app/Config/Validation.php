<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

use CodeIgniter\Validation\UserRules;

class Validation extends BaseConfig
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
		\App\Validation\UserRules::class,
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
	
		
	public $signup = [
        'user_id'       => 'required|trim',
        'password'      => 'required|validateUser[user_id,password]',
    ];

    public $signup_errors = [
        'user_id' => [
            'required'      =>  '아이디를 입력해 주세요.'
        ],
        'password' => [
            'required'      =>  '패스워드를 입력해 주세요.',
            'validateUser'  =>  '비밀번호가 같지 않습니다.'
        ]
    ];
}
