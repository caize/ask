<?php

class IndexController extends BasicController {

        private $m_question;

        public function init() {
                parent::init();
                $this->m_question = $this->load('question');
        }

        public function indexAction() {
                $page = $this->get('page');
                $keyword = $this->get('keyword');
                if (empty($page)) {
                        $page = 1;
                }
                $num = 10;
                $where="status=1";
                if($keyword){
                        $where.=" AND title like '%{$keyword}%'";
                }
                $counts = $this->m_question->Where($where)->Total();
                $questions = $this->m_question->Where($where)->Limit(($page - 1) * $num . ',' . $num)->Order(array('id'=>'desc'))->Select();
                $this->getView()->assign("questions", $questions);
                $pageClass=new Page($counts,$num);
                $this->getView()->assign('pageStr', $pageClass->showpage());
        }
}
