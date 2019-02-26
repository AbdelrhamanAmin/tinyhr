<?php
if(isset($_POST['signup']) ){
    // $ur = new UserRegistration();
    $form_input = array();
    $form_input['username'] = trim($_POST['username']);
    $form_input['password'] = trim($_POST['password']);
    $form_input['fullname'] = trim($_POST['fullname']);
    $form_input['job']      = trim($_POST['job']);

    $form = new FormValidation();
    foreach ($_POST as $key=> $value){
        $form->validate_input_field($key, $value);
    }

    $form->validate_username($form_input['username']);
    $form->validate_password($form_input['password']);

    $form->validate_file($_FILES['cv'],'cv',__CV_TYPE__);
    $form->validate_file($_FILES['photo'],'photo',__PHOTO_IMG_TYPE__);


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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./style.css">

</head>
<body>
    <form action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post" enctype="multipart/form-data">
        <label for="uname"><b>User Name</b></label>
        <input type = "text" name = "username" value = "<?php echo (isset($_POST['username']))? $_POST['username'] :Null; ?>" placeholder="Enter your  UserName" >

        <label for="uname"><b>Password</b></label>
        <input type = "password" name = "password" value = "" placeholder="Enter your Password" >

        
        <label for="uname"><b>Full Name</b></label>
        <input type = "text" name = "fullname" value = "<?php echo (isset($_POST['fullname']))? $_POST['fullname'] :""; ?>"  placeholder="Enter your Full Name" >

    
        <label for="uname"><b>job Title</b></label>
        <input type = "text" name = "job" value = "<?php echo (isset($_POST['job']))? $_POST['job'] :""; ?>"  placeholder="Enter your job" >

        <label>Upload photo</label>
        <input type="file"  name = "photo" ><br />
    
        <label>Upload cv</label>
        <input type="file"  name = "cv" > <br />


        <button  type = "submit" name = "signup" value="Sign up">Sign Up</button>
        <br>
        <label>
            <br>
            <a class="button" href="?login">Log in</a> 
        </label>

    </form>


</body>
</html>