<?php
if(isset($_POST['signup']) ){
    // $ur = new UserRegistration();
    $form_input = array();
    $form_input['username'] = trim($_POST['username']);
    $form_input['password'] = trim($_POST['password']);
    $form_input['fullname'] = trim($_POST['fullname']);
    $form_input['job']      = trim($_POST['job']);

    $form = new Form();
    foreach ($_POST as $key=> $value){
        $form->check_input_field($key, $value);
    }

    $form->check_username($form_input['username']);
    $form->check_password($form_input['password']);

    $form->check_file($_FILES['cv'],'cv',__CV_TYPE__);
    $form->check_file($_FILES['photo'],'photo',__PHOTO_IMG_TYPE__);


    if ($form->is_valid()){

        $unhashed_password = $form_input['password'];
        $form_input['password'] = hash('sha256',$password);
        $form_input['cv']      = $form_input['username'].'.pdf';
        $form_input['photo']    = $form_input['username'].'.jpeg';
        
        $db = new MySQLHandler('members');
        if(!$db->save($form_input)) echo "Something went wrong";
        
        $ma = new MemberAuthentication($form_input['username'],$unhashed_password);
        
        move_uploaded_file($_FILES['photo']['tmp_name'], __PHOTOS_DIR__.$_POST['username'].".jpeg");
        move_uploaded_file($_FILES['cv']['tmp_name'], __CVS_DIR__.$_POST['username'].".pdf");

        header("Refresh:0");
        die();
    
    }
// user registered redirect to his profile from index
    else {
        foreach($form->get_error_list() as $error){
            echo $error.'<br>';
        }  
    }
}
?>


<h4>Sign up</h4>

<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "post" enctype="multipart/form-data">
    <label>UserName  :</label>
    <input type = "text" name = "username" value ="<?php echo (isset($_POST['username']))? $_POST['username'] :"";?>"class = "box" placeholder="Enter your Name" /><br /><br />
    <label>Password  :</label>
    <input type = "password" name = "password" value = "" class = "box" placeholder="Enter your PassWord" /><br/><br />
    <label>Full Name  :</label>
    <input type = "text" name = "fullname" value ="<?php echo (isset($_POST['fullname']))? $_POST['fullname'] :Null;?>" class = "box" placeholder="Enter your Full Name" /><br/><br />
    <label>Job Title  :</label>
    <input type = "text" name = "job" class = "box" value ="<?php echo (isset($_POST['job']))? $_POST['job'] :Null;?>" placeholder="Enter your Job Title" /><br/><br />
    <label>Upload photo</label>
    <input type="file"  name = "photo" ><br />
    <label>Upload cv</label>
    <input type="file"  name = "cv" > <br />
    <input  type = "submit" name = "signup" value="Sign up"><br />
</form>	
<a href="?login">Log in</a> 
