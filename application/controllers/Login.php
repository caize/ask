<?php

class LoginController extends BasicController {

        public function init(){
		parent::init();
		$userID = $this->getSession('userID');
                $this->m_user = $this->load('user');
		if($userID){
			jsRedirect('/user/profile');
		}
	}

	public function indexAction() {
                
  	}

  	public function loginActAction(){
		$username = $this->getPost('username');
		$password = $this->getPost('password');

		$field = array('id');
		$where = array('username' => $username, 'password' => $password);
		$data  = $this->m_user->Field($field)->Where($where)->SelectOne();
		$userID = $data['id'];

		if($userID){
			// Set to session
			$this->setSession('userID', $userID);
			$this->setSession('username', $username);
			returnJson(true, '登陆成功');
		}else{
			returnJson(false, '用户名或密码错误！');
		}
	}
  	
}
