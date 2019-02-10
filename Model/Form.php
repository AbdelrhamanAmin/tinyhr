<?php 
class Form
{
    private $error_list = array();

    public function check_input_field($fieldname,$fieldvalue){
        if (empty($fieldvalue)){
            $this->error_list[$fieldname] = $fieldname." cannot be empty";
        }
    }

    public function check_username($username){
        $db = new MySQLHandler("members");
        $results = $db->get_record_by_field('username', $username);
        if ($results) {
            // array_push( $this->errors,"The username \"". $this->input_fields['username']."\" already exists");    
            $this->error_list['username'] = "The username \"" . $username . "\" already exists";
        }
    }

    public function check_password($password){
        if (!empty($password)) {

            if (strlen($password) < __MIN_PWD_LEN__) {
                $this->error_list['password'] = "Password is too short";
            }
            if (strlen($password) > __MAX_PWD_LEN__) {
                $this->error_list['password'] = "Password is too big";
            }

        }
    }

    public function check_file($file,$filename, $correct_file_type, $is_optional = false){

        if ($file['error'] != __UPLOAD_ERR_NO_FILE__ || $is_optional) {
            
            if ($file['size'] > __MAX_FILE_SIZE__ || $file['error']==__UPLOAD_ERR_INI_SIZE__ 
                || $file['error'] == __UPLOAD_ERR_FORM_SIZE__ ) {
            
                $this->error_list[$filename] = $filename . " is too large maximum size is 1 MB";
                
                if ($file['type'] != $correct_file_type) {
                    $this->error_list[$filename] = "Only " . $correct_file_type . " is allowed";
                }
                return false;
            }
        } else {
            
            $this->error_list[$filename] = $filename . " cannot be empty";
            return false;
        }
        return true;
    }

    public function get_error_list(){
        return $this->error_list;
    }

    public function is_valid(){
        return (count($this->error_list)>0) ? false: true;
    }
}