<?php

class MemberAuthentication {
    private $valid;
    private $member;

    public function __construct($username, $password){
        $db= new MySQLHandler("members");

        $result = $db->get_record_by_field("username", $username);
        // var_dump($result[0]);
         // ADD check exists condition 
        if($result){
            $result = $result[0];
            $this->member = $result;
            $this->valid  = ((trim( $this->member['password'])) === trim(hash('sha256',$password)))? true : false;
            self::set_session($this->member['isadmin'],$this->member['id']);
        }
    }

    public function is_valid(){
        return $this->valid;
    }
     
    public static function set_session($isadmin,$id){
        $_SESSION['is_admin'] =  $isadmin;
        $_SESSION['user_id'] = $id;
    }

}