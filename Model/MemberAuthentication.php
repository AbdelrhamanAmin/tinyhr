<?php

class MemberAuthentication {
    private $valid;
    private $member;

    public function __construct(){
        $db= new MySQLHandler("members");

        $result = $db->get_single_record("username", $_POST['username']);
         // ADD check exists condition 
        if($result){
            $this->member = $result;
            $this->valid  = ((trim( $this->member['password'])) === trim(hash('sha256',$_POST['password'])))? true : false;
            $this->set_session();
        }
        $db->disconnect();
    }

    public function is_valid(){
        return $this->valid;
    }

     
    public function set_session(){
        echo '<pre>' . var_export($_SESSION, true) . '</pre>';
        $_SESSION['is_admin'] =  $this->member['isadmin'];
        $_SESSION['user_id'] = $this->member['id'];
    }

}