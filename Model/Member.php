<?php
class Member
{
    public $fullname;
    public $username;
    public $photo;
    public $cv;
    public $is_admin;
    public $job;
    public $id;
    public $password;


    public function get_member_by_id($id){
        $db= new MySQLHandler("members");
        $member = $db->get_single_record("id",$id)[0];

        $db->disconnect();
        $this->is_admin = $member['isadmin'];
        $this->fullname = $member['fullname'];
        $this->username = $member['username'];
        $this->job = $member['job'];
        $this->id = $member['id'];
        $this->cv = $member['cv'];
        $this->photo = $member['photo'];

        // $_SESSION["is_admin"] = $this->is_admin; //???????
        // $_SESSION["user_id"] = $this->id; //???????
    }
 

    // public function login(){
    //     $auth = new MemberAuthentication();
    //     if ($auth->is_valid()){
    //         $auth->set_session();
    //     }

    // }
    
   
}