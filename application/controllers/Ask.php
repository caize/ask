<?php

class AskController extends BasicController {

        private $m_question;

        public function init() {
                parent::init();
                $userID = $this->getSession('userID');
                if (!$userID) {
                        jsRedirect('/login');
                }
                $this->m_question = $this->load('question');
        }

        public function indexAction() {
                
        }

        public function editAction() {
                $id = $this->get('id');
                $question = $this->m_question->Where(array('id' => $id))->SelectOne();
                if(!checkAuth($this->getSession('userID'), $question['user_id'])){
                        jsRedirect('question?id='.$id);
                }
                $this->getView()->assign('question', $question);
        }

        public function pushAction() {
                $id = $this->getPost('id');
                $m['title'] = $this->getPost('title');
                if (empty($m['title'])) {
                        returnJson(FALSE, "错误的标题");
                }
                $tags = $this->getPost('tag');
                $tags = explode(";", $tags);
                $m['tags'] = implode(';', $tags);
                $m['content'] = addslashes($this->getPost('content',false));
                if (empty($m['content'])) {
                        returnJson(FALSE, "错误的内容");
                }
                $m['user_id'] = $this->getSession('userID');
                $m['create_time'] = time();
                $m['update_time'] = time();
                if (empty($id)) {
                        $m['status'] = 1;
                        $id = $this->m_question->Insert($m);
                        if ($id) {
                                returnJson(true, '发布成功', array('id' => $id));
                        } else {
                                returnJson(false, '发布失败');
                        }
                } else {
                        $rs = $this->m_question->Where(array('id' => $id))->Update($m);
                        if ($rs) {
                                returnJson(true, '更新成功', array('id' => $id));
                        } else {
                                returnJson(false, '更新失败');
                        }
                }
        }

}
