<?php

class QuestionController extends BasicController {

        private $m_question;
        private $m_answer;

        public function init() {
                parent::init();
                $this->m_question = $this->load('question');
                $this->m_answer = $this->load('answer');
        }

        public function indexAction() {
                $question_id = $this->get('id');
                $question = $this->m_question->Where(array("id" => $question_id))->SelectOne();
                $this->getView()->assign('question', $question);
                
                $answer = $this->m_answer->Where(array("question_id" => $question_id))->Select();
                $this->getView()->assign('answers', $answer);
        }

}
