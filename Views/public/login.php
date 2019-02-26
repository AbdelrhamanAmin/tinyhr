<?php 
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']) ) {
    $auth= new MemberAuthentication($_POST['username'],$_POST['password']);

    if ($auth->is_valid()){
        header("Refresh:0");
        die();
    }
    else {
        echo "Username and password do not match";
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?> " method = "post">


  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name = "username"  required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name = "password" required>
        
    <button  type = "submit" name = "login">Login</button>
    <label>
    <a href="?signup">Sign up</a>
    </label>
  </div>
  </div>
</form>

