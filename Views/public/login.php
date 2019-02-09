<?php 
echo "Login page";
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']) ) {
    $auth= new MemberAuthentication();

    if ($auth->is_valid()){
        header("Refresh:0");
        die();
    }
    else {
        echo "Username and password do not match";
    }
}
?>

<form action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post">
    <label>UserName  :</label>
    <input type = "text" name = "username" class = "box" placeholder="Enter your Name" /><br /><br />
    <label>Password  :</label>
    <input type = "password" name = "password" class = "box" placeholder="Enter your PassWord" /><br/><br />
    <button  type = "submit" name = "login" >Login</button><br />
</form>	
<a href="?signup">Sign up</a>