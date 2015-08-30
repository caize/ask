<?php

class UserController extends BasicController {

        public function indexAction() {
                echo 'ddd';
                exit;
        }

        public function loginOutAction() {
                $this->setSession('userID', "");
                $this->setSession('username', "");
                jsRedirect("/");
        }
        
        public function profileAction(){
                
        }

}
