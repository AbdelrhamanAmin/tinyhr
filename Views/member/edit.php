<?php

$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];


if(isset($_POST['update'])){    
    $db = new MySQLHandler('members');

    $input_fields = array(
        "fullname"=>$_POST['fullname'],
        "job"=>$_POST['job'],
        "password"=>$_POST['password'],
     );

    $updated_files = array();
    foreach($_FILES as $file){
        if (!empty($file['name'])){
            $updated_files [] = $file;
        }
    }
    echo '<pre>' . var_export($_FILES, true) . '</pre>';
    echo '<pre>' . var_export($updated_files, true) . '</pre>';
    $form = new FormValidation($input_fields, $updated_files);

    $errors = $form->get_errors_list();
    if (count($errors)>0){
        foreach($errors as $error){
            echo $error.'<br>';
            }
        }
    // user registered redirect to his profile from index
    else {
        // put session id
        $edited_values = array_merge($input_fields, $updated_files);
         
        $user = $db->update($edited_values, $_SESSION['user_id']);
        header("Refresh:0");
        die();
    }  
}

?>


<h4>Edit Profile</h4>

<form  action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post" enctype="multipart/form-data">
    <label>UserName  :</label>
    <input type = "text" name = "username" value = "<?php echo $user['username']; ?> "class = "box" placeholder="Enter your Name" /><br /><br />
    <label>Password  :</label>
    <input type = "password" name = "password" value = "" class = "box" placeholder="Enter your PassWord" /><br/><br />
    <label>Full Name  :</label>
    <input type = "text" name = "fullname" value = "<?php echo $user['fullname'];?> " class = "box" placeholder="Enter your Full Name" /><br/><br />
    <label>Job Title  :</label>
    <input type = "text" name = "job" class = "box" value = "<?php echo $user['job']; ?>" placeholder="Enter your Job Title" /><br/><br />
    <label>Upload photo</label>
    <input type="file"   name = "photo"  ><br />
    <label>Upload cv</label>
    <input type="file"  name = "cv" > <br />
    <input  type = "submit" name = "update" value="update"><br />
</form>	

<a href="?profile"> back </a>