<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules
{
  
  public function validateUser(string $str, string $fields, array $data){
    $model = new UserModel();    
    $user = $model->where('user_id', $data['user_id'])
				  ->where('use_yn', 'Y')
                  ->first();
    
    if(!$user) return;
    if($data['password']){
        $user_pw_hash	=	password_hash( $user['passwd'], PASSWORD_DEFAULT);
        return password_verify($data['password'], $user_pw_hash);
    }
  }
}