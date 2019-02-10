<?php


$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];

if(isset($_POST['update'])){    

    $form = new Form();
    
    $form_input = array();
    $form_input['fullname'] = trim($_POST['fullname']);
    $form_input['job']      = trim($_POST['job']);
    
    echo '<pre>' . var_export($form_input, true) . '</pre>';
    
    foreach ($_POST as $key=> $value){
        $form->check_input_field($key, $value);
    }
    
    
    if(!empty($_FILES['cv']['name'])){
        if($form->check_file($_FILES['cv'],'cv',__CV_TYPE__)){
            $form_input['cv']      = $form_input['username'].'.pdf';
            move_uploaded_file($_FILES['cv']['tmp_name'], __CVS_DIR__.$_POST['username'].".pdf");
        }
    }
    if(!empty($_FILES['photo']['name'])){    
        if($form->check_file($_FILES['photo'],'photo',__PHOTO_IMG_TYPE__)){
            $form_input['photo']   = $form_input['username'].'.jpeg';
            move_uploaded_file($_FILES['photo']['tmp_name'], __PHOTOS_DIR__.$_POST['username'].".jpeg");
        }
    }
    
    
    
    
    if ($form->is_valid()){
        
        $db->connect();
        $db->update($form_input, $_SESSION['user_id']);

        header('Location: /tiny/index.php');
        die();
    }
    else {
        foreach($form->get_error_list() as $error){
            echo $error.'<br>';
        }  
    }
}

?>


<h4>Edit Profile</h4>
<form  method= "post" enctype="multipart/form-data">
    <label>Full Name  :</label>
    <input type = "text" name = "fullname" value ="<?php echo $user['fullname'];?>" class = "box" placeholder="Enter your Full Name" /><br/><br />
    <label>Job Title  :</label>
    <input type = "text" name = "job" class = "box" value = "<?php echo $user['job']; ?>" placeholder="Enter your Job Title" /><br/><br />
    <label>Upload photo</label>
    <input type="file"   name = "photo"  ><br />
    <label>Upload cv</label>
    <input type="file"  name = "cv" > <br />
    <input  type = "submit" name = "update" value="update"><br />
</form>	

<a href="?profile"> back </a>