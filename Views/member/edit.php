<?php


$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];

if(isset($_POST['update'])){    

    $form = new FormValidation();
    
    $form_input = array();
    $form_input['fullname'] = trim($_POST['fullname']);
    $form_input['job']      = trim($_POST['job']);
    
    // echo '<pre>' . var_export($form_input, true) . '</pre>';
    
    foreach ($_POST as $key=> $value){
        $form->validate_input_field($key, $value);
    }
    
    
    if(!empty($_FILES['cv']['name'])){
        if($form->validate_file($_FILES['cv'],'cv',__CV_TYPE__)){
            $form_input['cv']      = $form_input['username'].'.pdf';
            
            move_uploaded_file($_FILES['cv']['tmp_name'], __CVS_DIR__.$_POST['username'].".pdf");
        }
    }
    if(!empty($_FILES['photo']['name'])){    
        if($form->validate_file($_FILES['photo'],'photo',__PHOTO_IMG_TYPE__)){
            $form_input['photo']   = $form_input['username'].'.jpeg';
            
            move_uploaded_file($_FILES['photo']['tmp_name'], __PHOTOS_DIR__.$_POST['username'].".jpeg");
        }
    }
    
    
    
    
    if ($form->is_valid()){
        
        $db->connect();
        $db->update($form_input, $_SESSION['user_id']);

        header("Location: ".__PRJ_DIR__."index.php");
        die();
    }
    else {
        foreach($form->get_error_list() as $error){
            echo $error.'<br>';
        }  
    }
}

?>



<form form  method= "post" enctype="multipart/form-data">
  <div class="container">
    
    <label for="uname"><b>Full Name</b></label>
    <input type = "text" name = "fullname" value ="<?php echo $user['fullname'];?>"  placeholder="Enter your Full Name" required>

   
    <label for="uname"><b>job Title</b></label>
    <input type = "text" name = "job" class = "box" value = "<?php echo $user['job']; ?>" placeholder="Enter your job" required>

    <label>Upload photo</label>
    <input type="file"  name = "photo" ><br />
  
    <label>Upload cv</label>
    <input type="file"  name = "cv" > <br />


    <button   type = "submit" name = "update" value="update">Update</button>
    <label>
    <a href="?profile"> back </a> 

    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
  </div>
</form>

