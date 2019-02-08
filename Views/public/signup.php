<?php
if(isset($_POST['signup']) ){
    $ur = new UserRegistration();
    // echo '<pre>' . var_export($ur, true) . '</pre>';
    $errors = $ur->get_errors_list();
    if (count($errors)>0){
        foreach($errors as $error){
            echo $error.'<br>';
            
            }
        }
    // user registered redirect to his profile from index
    else {
        // put session id 
        header("Refresh:0");
        die();
    }  
}
?>


<h4>Sign up</h4>

<form action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post" enctype="multipart/form-data">
    <label>UserName  :</label>
    <input type = "text" name = "username" value = "<?php echo (isset($_POST['username']))? $_POST['username'] :""; ?> "class = "box" placeholder="Enter your Name" /><br /><br />
    <label>Password  :</label>
    <input type = "password" name = "password" value = "" class = "box" placeholder="Enter your PassWord" /><br/><br />
    <label>Full Name  :</label>
    <input type = "text" name = "fullname" value = "<?php echo (isset($_POST['username']))? $_POST['fullname'] :""; ?> " class = "box" placeholder="Enter your Full Name" /><br/><br />
    <label>Job Title  :</label>
    <input type = "text" name = "job" class = "box" value = "<?php echo (isset($_POST['username']))? $_POST['job'] :""; ?> " placeholder="Enter your Job Title" /><br/><br />
    <label>Upload photo</label>
    <input type="file"  name = "photo" ><br />
    <label>Upload cv</label>
    <input type="file"  name = "cv" > <br />
    <input  type = "submit" name = "signup" value="Sign up"><br />
</form>	
<a href="?login">Log in</a> 
