<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginInfoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'login_info';
    // protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'login_time', 'ilja', 'ip', 'gubun'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
		'user_id'		=>	'required|min_length[2]',
		'login_time'	=>	'required|valid_date[Y-m-d H:i:s]',
		'ilja'			=>	'required|valid_date[Y-m-d]',
		'ip'			=>	'required',
        'gubun'         =>  'required'
	];
	protected $validationMessages   = [
		'user_id'	=>[
			'required' => '아이디에 문제가 있습니다.'
		],
		'login_time'	=>[
			'valid_date' => '시간에 문제가 있습니다.'
		],
		'ilja'	=>[
			'valid_date' => '일자가 유효하지 않습니다.'
		],
		'ip'	=>[
			'required' => '아이피에 문제가 있습니다.'
		],
        'gubun' =>[
			'required' => '구분에 문제가 있습니다.'
		]
	];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
	
	

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}