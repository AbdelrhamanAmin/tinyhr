<?php 

class UserRegistration
{
    private $errors = array();


    
    public function __construct()
    {
        $this->validate_username();
        $this->validate_post();
        $this->validate_files();

        if(count($this->errors) ==0){
            $this->insert_new_user();

            $db = new MySQLHandler('members');
            $user = $db->get_single_record('username',$_POST['username']);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['isadmin'];

        }
        
        
    }

    public function get_errors_list(){
        return $this->errors;
    }


    private function validate_post(){
        $post_fields = ['username', 'password', 'fullname', 'job'];
        
        foreach($post_fields as $field){
            if(empty($_POST[$field])) {
                array_push($this->errors," $field is required");
            }
        }
    }

    private function validate_files(){

            $file_types = ['image/jpeg','application/pdf'];
            $file_type_index = 0;
            foreach($_FILES as $file => $content ){
            if($_FILES[$file]['name'] == ""){
                array_push($this->errors, $file." is required");
            }
            else {
                if($_FILES[$file]['type'] != $file_types[$file_type_index]){

                    array_push($this->errors, "Only ".$file_types[$file_type_index]." is allowed");

                    if($_FILES[$file]['size'] > __MAX_FILE_SIZE__ || $_FILES[$file]['error']){
                        array_push($this->errors, $file." is too large maximum size is 1 MB");
                    }
                }

            }
            $file_type_index++;
        }
    }

    private function validate_username(){
        $db = new MySQLHandler("members");
        $results  = $db->get_single_record('username',$_POST['username']);
        
        if($results){
           array_push( $this->errors,"The username \"". $_POST['username']."\" already exists");    
        }

    }

    private function insert_new_user(){
        $hashed_pw = hash('sha256',$_POST['password']);
        

        /// ------------------------------------------ BEWARE OF SQL INJECTIONS 
        $sql = "INSERT INTO members(isadmin, username, fullname, photo, cv, job, password )VALUES ( 
        '0','"
        .$_POST['username']."','"
        .$_POST['fullname']."','"
        .$_POST['username'].".jpeg" ."','"
        .$_POST['username'].".pdf"  ."','"
        .$_POST['job']."','"
        .$hashed_pw."'
        );";

        // ------------------------------------------ TESTTTTTT THE FOLLOWING ON UBUNTU 
        echo __PHOTOS_DIR__.$_POST['username'].".jpeg";
        move_uploaded_file($_FILES['photo']['tmp_name'], __PHOTOS_DIR__.$_POST['username'].".jpeg");
        move_uploaded_file($_FILES['cv']['tmp_name'], __CVS_DIR__.$_POST['username'].".pdf");


        $db = new MySQLHandler('members');
        $db->execute_query($sql);
        $db->disconnect();
    }



}