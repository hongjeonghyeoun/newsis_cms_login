<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoginInfoModel;
use App\Models\NewsisorgModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Cookie\Cookie;
use DateTime;
use DateTimeZone;

class Users extends BaseController
{
	private $cookie_list		=	array(
		 'CMS_USER_NAME'     		        =>  ''
		,'CMS_USER_DESK' 			        =>  ''
		,'CMS_REPUBLISH_YN' 		        =>  ''
		,'CMS_USER_BUSEO_ID' 		        =>  ''
		,'CMS_PROFILE_LEVEL' 		        =>  ''
		,'CMS_PROFILE_MOBILE' 		        =>  ''
		,'CMS_USER_BUSEO_NAME' 		        =>  ''
		,'CMS_USER_PROFILE_BUSEO_ID' 		=>  ''
		,'CMS_USER_PROFILE_BUSEO_NAME' 		=>  ''
		,'CMS_USER_PROFILE_BUSEO_UP_NAME' 	=>  ''
		,'CMS_RELOAD_TIME' 		        	=>  ''
		,'CMS_LEVEL_NM'				        =>  ''
		,'CMS_LAST_CONNECT_TIME'        	=>  ''
	);


    public function index()
    {
        helper(['form', 'cookie']);
        $validation =   \Config\Services::validation();
        $data       =   [];

        if($this->request->getMethod() == 'post') {
			$data = [
				"user_id" 	=>	$this->request->getVar("user_id"),
				"password" 	=>	$this->request->getVar("password"),
			];

			$data['validation']	=	$validation;

			//빈값 아닐시
			if($validation->run($data, 'signup')){

				$user_model     =	new UserModel();
                $login_field    =	['user_id' => $data['user_id']];
				$user		    =	$user_model->where($login_field)->first();

				if($user){
                    $time  		        =   Time::parse('now');
                    $conn_data	        =   [];
                    $toDateTimeString	=	$time->toDateTimeString();
                    $toDateString		=	$time->toDateString();

					//체크 박스 동의 여부
					if($this->request->getVar("id_check") == 'Y'){
						set_cookie('id_check', 'Y', 0, $this->my_app_path);
						set_cookie('id_check_id', $user['user_id'], 0, $this->my_app_path);
					}else{
						set_cookie('id_check', 'N', 0 ,$this->my_app_path);
						set_cookie('id_check_id', '',0 ,$this->my_app_path);
					}

					//접속시간 데이터
					$user_ip	=	$this->request->getIPAddress();	//user ip
					$conn_data = [
                        'user_id'		=>	$user['user_id'],
                        'login_time' 	=>	$toDateTimeString,
                        'ilja' 			=>	$toDateString,//toTimeString//toDateString
                        'ip' 			=>	$user_ip,	//22230222	//user_ip
                        'gubun'			=>	'cms'
					];

					$login_model  = new LoginInfoModel();
					
					//접속 정보가 에러가 있으면 에러처리
					if ($login_model->save($conn_data) === false) {
						$data['login_info_err']	=	$login_model->errors();
					}else{

						$org_model			=	new NewsisorgModel();
						$buseo_field 	    =	['org_id' => $user['org_id'], 'use_yn' => 'Y'];
						$buseo_row		    =	$org_model->where($buseo_field)->first();
						$edit_buseo_row		=   $org_model->editorial_buseo_search($user['profile_org_id']);

						$session_data	= [
							'user_id' 	=>	$user['user_id'],
						];
						session()->set($session_data);

						// 사용자 정보 쿠키 저장
                        $cookie_data                                    =   $this->cookie_list;
                        $cookie_data['CMS_USER_NAME']       	        =   $user['user_nm'];
                        $cookie_data['CMS_USER_DESK'] 	    	        =   $user['desk_yn'];
                        $cookie_data['CMS_REPUBLISH_YN'] 		        =   $user['republish_yn'];
                        $cookie_data['CMS_PROFILE_LEVEL'] 	            =   $user['profile_level'];
                        $cookie_data['CMS_PROFILE_MOBILE'] 	            =   $user['profile_mobile'];
                        $cookie_data['CMS_USER_BUSEO_ID']		        =   $buseo_row['org_id'];
                        $cookie_data['CMS_USER_BUSEO_NAME'] 	        =   $buseo_row['org_nm'];
                        $cookie_data['CMS_RELOAD_TIME'] 		        =   $user['reload_time'];
                        $cookie_data['CMS_LEVEL_NM'] 			        =   $user['level_nm'];
                        $cookie_data['CMS_LAST_CONNECT_TIME']           =   $toDateString;
                        $cookie_data['CMS_USER_PROFILE_BUSEO_ID']       =   $edit_buseo_row['org_id'];
                        $cookie_data['CMS_USER_PROFILE_BUSEO_NAME']     =   $edit_buseo_row['org_nm'];
                        $cookie_data['CMS_USER_PROFILE_BUSEO_UP_NAME']	=   $edit_buseo_row['up_profile_org_nm'];

						foreach($this->cookie_list as $key => $value){
                            delete_cookie("{$key}",$this->my_app_path);
						}
						//쿠키set
						foreach($cookie_data as $key => $value){
                        set_cookie("{$key}", $value, 0, $this->my_app_path);
						}
					}

					return redirect()->to('dashboard')->withCookies();

				}else{
                    $data['login_check_err']	=	array('val'=>'존재하지 않는 아이디 입니다.');
                }
			}
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
    }

	public function logout(){
        helper('cookie');
		session()->destroy();
        foreach($this->cookie_list as $key => $value){
            delete_cookie("{$key}",$this->my_app_path);
		}
		return redirect()->to('/')->withCookies();
	}
}