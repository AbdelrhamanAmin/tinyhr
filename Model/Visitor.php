<?php 
    class Visitor
    {
        private $page;

        public function __construct(){
            if (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === true) {
                //admin views should be required here
                if (isset($_GET['page'])){
                    $this->page = 'admin/'.$_GET['page'];
                }else{
                    $this->page = 'admin/users';
                }
            } elseif (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === false) {
                //members views should be required here
                if (isset($_GET['page'])){
                    $this->page = 'member/'.$_GET['page'];
                }else{
                    $this->page = 'member/profile';
                }
            } else {
                //public views should be required here
                if (isset($_GET['page'])){
                    $this->page = 'public/'.$_GET['page'];
                }
                else{
                    $this->page = 'public/login';
                }
            }
        }

        public function get_page(){
            return $this->page;
        }
    }   
?>