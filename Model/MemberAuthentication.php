<?php

class MemberAuthentication {
    private $valid;
    private $member;

    public function __construct(){
        $db= new MySQLHandler("members");

        $result = $db->get_record_by_field("username", $_POST['username']);
        // var_dump($result[0]);
         // ADD check exists condition 
        if($result){
            $result = $result[0];
            $this->member = $result;
            $this->valid  = ((trim( $this->member['password'])) === trim(hash('sha256',$_POST['password'])))? true : false;
            $this->set_session();
        }
    }

    public function is_valid(){
        return $this->valid;
    }

     
    public function set_session(){
        $_SESSION['is_admin'] =  $this->member['isadmin'];
        $_SESSION['user_id'] = $this->member['id'];
    }

}