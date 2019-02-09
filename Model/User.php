<?php class User
{
    private $username;
    private $fullname;
    private $photo;
    private $cv;
    private $job;
    private $password;
    
    public function insert_new_user(){
        
        // echo '<pre>' . var_export($values  = array();
        $values ['isadmin' ] = 0;
        $values ['username'] = trim($_POST['username']);
        $values ['fullname'] = trim($_POST['fullname']);
        $values ['photo']    = trim($_POST['username']).".jpeg";
        $values ['cv']       = trim($_POST['username']).".pdf";
        $values ['job']      = trim($_POST['job']);
        $values ['password'] = hash('sha256',trim($_POST['password']));

        $this->username = $values['username'];
        
        move_uploaded_file($_FILES['photo']['tmp_name'], __PHOTOS_DIR__.$_POST['username'].".jpeg");
        move_uploaded_file($_FILES['cv']['tmp_name'], __CVS_DIR__.$_POST['username'].".pdf");

        $db = new MySQLHandler('members');
        $db->save($values);
    }

    public function set_session(){
        $db = new MySQLHandler('members');

        $u = $db->get_record_by_field('username',$_POST['username'])[0];
        echo '<pre>' . var_export($u, true) . '</pre>';
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['is_admin'] = $u['isadmin'];
        echo '<pre>' . var_export($_SESSION, true) . '</pre>';
    }


}