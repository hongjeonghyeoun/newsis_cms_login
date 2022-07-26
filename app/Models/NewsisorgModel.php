<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsisorgModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'newsis_org';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
	
	public function editorial_buseo_search($buseoID){
/*
        기본 쿼리 메모리 : 4408
        기존 쿼리 메모리 : 7184
        수정 쿼리 메모리 : 6096
        
        $ssubquery  =   $this->db->table("newsis_org b")->select('profile_up_org_id')->where('b.org_id', $buseoID);
        $subquery   =   $this->db->table("newsis_org b")->select('org_nm')->where('b.org_id', $ssubquery);
        $builder    =   $this->db->table("newsis_org a")->select('a.org_id,a.org_nm,a.profile_up_org_id')->selectSubquery($subquery, 'up_profile_org_nm');
*/        
   
        $builder    =   $this->db->table("newsis_org a")->select('a.org_id,a.org_nm,a.profile_up_org_id,b.org_nm as up_profile_org_nm')
                    ->  join("newsis_org b", "b.org_id = a.profile_up_org_id", 'inner')
                    ->  where('a.org_id', $buseoID)
                    ->  where('a.profile_yb', 1);
        $query      =   $builder->get();
        
		return $query->getRowArray();
	}

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
