<?php
    class Answers {
        public $question_name;
        public $answer_name;
        public $title;
        public $answer;
        public $answered_document;
        public $liked;
        public $verified;
        public $created_at;
      
        function __construct($question_name, $answer_name, $title, $answer, $answered_document, $liked, $verified, $created_at) {
          $this->question_name = $question_name;
          $this->answer_name = $answer_name;
          $this->title = $title;
          $this->answer = $answer;
          $this->answered_document = $answered_document;
          $this->liked = $liked;
          $this->verified = $verified;
          $this->created_at = $created_at;
        }
        function get_question_name() {
          return $this->question_name;
        }
        function get_answer_name() {
          return $this->answer_name;
        }
        function get_title() {
          return $this->title;
        }
        function get_answer() {
          return $this->answer;
        }
        function get_answered_document() {
          return $this->answered_document;
        }
        function get_liked() {
          return $this->liked;
        }
        function get_verified() {
          return $this->verified;
        }
        function get_created_at() {
          return $this->created_at;
        }
      }
?>