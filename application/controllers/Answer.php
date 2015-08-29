<?php

class AnswerController extends BasicController {

        private $m_answer;

        public function init() {
                parent::init();
                $this->m_answer = $this->load('answer');
        }

        public function pushAction() {
                $id = $this->getPost('id');
                $m['question_id'] = $this->getPost('question_id');
                $m['content'] = $this->getPost('content');
                if (empty($m['content'])) {
                        returnJson(FALSE, "错误的内容");
                }
                $m['user_id'] = $this->getSession('userID');
                $m['create_time'] = time();
                $m['update_time'] = time();
                if (empty($id)) {
                        $m['status'] = 1;
                        $id = $this->m_answer->Insert($m);
                        if ($id) {
                                returnJson(true, '发布成功', array('id' => $id));
                        } else {
                                returnJson(false, '发布失败');
                        }
                } else {
                        $rs = $this->m_answer->Where(array('id' => $id))->Update($m);
                        if ($rs) {
                                returnJson(true, '更新成功', array('id' => $id));
                        } else {
                                returnJson(false, '更新失败');
                        }
                }
        }

}
