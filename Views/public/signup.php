<?php
if(isset($_POST['signup']) ){
    $ur = new UserRegistration();
    // echo '<pre>' . var_export($ur, true) . '</pre>';
    if (count($ur->get_errors_list())>0){
        foreach($ur->get_errors_list() as $error){
            echo $error.'<br>';
            }
        }
    // user registered redirect to his profile
    else {
        // put session id 
        header("Refresh:0");
//        require_once('./Views/member/profile.php');
//        var_dump($_SESSION);
        die();
    }  
}
?>


<h4>Sign up</h4>

<form action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post" enctype="multipart/form-data">
    <label>UserName  :</label><input type = "text" name = "username" class = "box" placeholder="Enter your Name" /><br /><br />
    <label>Password  :</label><input type = "password" name = "password" class = "box" placeholder="Enter your PassWord" /><br/><br />
    <label>Full Name  :</label><input type = "text" name = "fullname" class = "box" placeholder="Enter your Full Name" /><br/><br />
    <label>Job Title  :</label><input type = "text" name = "job" class = "box" placeholder="Enter your Job Title" /><br/><br />
    <label>Upload photo</label><input type="file"  name = "photo" ><br />
    <label>Upload cv</label><input type="file"  name = "cv" > <br />
    <input  type = "submit" name = "signup" value="Sign up"><br />
</form>	