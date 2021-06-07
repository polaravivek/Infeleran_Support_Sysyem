<?php
    class Questions {
        public $email;
        public $title;
        public $category;
        public $description;
        public $document;
        public $unsolved;
        public $solved;
        public $created_at;
      
        function __construct($email, $title, $category, $description, $document, $unsolved, $solved, $created_at) {
          $this->email = $email;
          $this->title = $title;
          $this->category = $category;
          $this->description = $description;
          $this->document = $document;
          $this->unsolved = $unsolved;
          $this->solved = $solved;
          $this->created_at = $created_at;
        }
        function get_email() {
          return $this->email;
        }
        function get_title() {
          return $this->title;
        }
        function get_category() {
          return $this->category;
        }
        function get_description() {
          return $this->description;
        }
        function get_document() {
          return $this->document;
        }
        function get_unsolved() {
          return $this->unsolved;
        }
        function get_solved() {
          return $this->solved;
        }
        function get_created_at() {
          return $this->created_at;
        }
      }
?>