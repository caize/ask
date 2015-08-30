<?php

class RegisterController extends BasicController {

        public function init() {
                parent::init();
                $userID = $this->getSession('userID');

                if ($userID) {
                        jsRedirect('/user/profile');
                }
        }

        public function indexAction() {
                
        }

        public function checkEAction() {
                $m['email'] = $this->get('email');
                $field = array('id');
                $rs = $this->m_user->Field($field)->Where($m)->SelectOne();
                if (empty($rs)) {
                        returnJson(true, '邮箱可以用');
                } else {
                        returnJson(false, '邮箱已被注册');
                }
        }

        public function checkUAction() {
                $m['username'] = $this->get('username');
                $field = array('id');
                $rs = $this->m_user->Field($field)->Where($m)->SelectOne();
                if (empty($rs)) {
                        returnJson(true, '用户名可以用');
                } else {
                        returnJson(false, '用户名已被注册');
                }
        }

        public function registerActAction() {
                $m['username'] = $this->getPost('username');
                $m['email'] = $this->getPost('email');
                $m['password'] = $this->getPost('password');
                $confirmPassword = $this->getPost('confirmPassword');
                if (!$m['username'] || !$m['password'] || !$m['email'] || !$m['confirmPassword']) {
                        $error = '您所提交的信息不完整！';
                        returnJson(false, $error);
                }
                if ($m['password'] != $confirmPassword) {
                        $error = '两次输入密码不一致！';
                        returnJson(false, $error);
                }
                $m['create_time'] = time();
                $userID = $this->m_user->Insert($m);
                if (!$userID) {
                        $error = '注册失败,请重试';
                        returnJson(false, $error);
                } else {
                        $msg = '注册成功,请登录';
                        returnJson(true, $msg);
                }
        }

}
