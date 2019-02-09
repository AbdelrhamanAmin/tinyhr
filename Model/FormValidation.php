<?php 
class FormValidation
{
    private $input_fields = array(); // => assosciative array with $this->input_fields fields as values
    private $files_uploaded = array(); // => assosciative array with $this->input_fields fields as values
    private $errors = array();

    // ['username', 'password', 'fullname', 'job']; => signup
    public function __construct($input_fields, $files_uploaded = null)
    {
        $this->input_fields = $input_fields;
        $this->clean_fields();
        $this->validate_post();
        if (isset($this->input_fields['username'])) {
            $this->validate_username();
        }
        if (isset($this->input_fields['password'])) {
            $this->validate_password();
        }
        if ($files_uploaded) {
            $this->validate_files();
        }
        if (__DEBUG_MODE__) echo $this;
    }

    private function clean_fields()
    {
        foreach ($this->input_fields as $key => $value) {
            $this->input_fields[$key] = strtolower(trim($value));
        }
    }

    private function validate_post()
    {
        foreach ($this->input_fields as $key=>$field) {
            if (empty($this->input_fields[$key])) {
                $this->errors[$key] = $key . " is required";
            }
        }
    }

    private function validate_password()
    {
        if (!empty($this->input_fields['password'])) {

            if (strlen($this->input_fields['password']) < __MIN_PWD_LEN__) {
                $this->errors['password'] = "Password must be greater than 8 characters";
            }
            if (strlen($this->input_fields['password']) > __MAX_PWD_LEN__) {
                $this->errors['password'] = "Password must be less than 16 characters";
            }

        }
    }

    private function validate_username()
    {
        $db = new MySQLHandler("members");
        $results = $db->get_record_by_field('username', trim($this->input_fields['username']));
        if ($results) {
            // array_push( $this->errors,"The username \"". $this->input_fields['username']."\" already exists");    
            $this->errors['username'] = "The username \"" . $this->input_fields['username'] . "\" already exists";
        }
    }

    private function validate_files()
    {
        $file_types = ['image/jpeg', 'application/pdf'];
        $file_type_index = 0;
        foreach ($_FILES as $file => $content) {
            if ($_FILES[$file]['name'] == "") {
                $this->errors[$file] = $file . " is required";
            } else {
                if ($_FILES[$file]['type'] != $file_types[$file_type_index]) {
                    $this->errors[$file] = "Only " . $file_types[$file_type_index] . " is allowed";
                    if ($_FILES[$file]['size'] > __MAX_FILE_SIZE__ || $_FILES[$file]['error']) {
                        $this->errors[$file] = $file . " is too large maximum size is 1 MB";
                    }
                }
            }
            $file_type_index++;
        }
    }

    public function get_errors_list()
    {
        return $this->errors;
    }
} 