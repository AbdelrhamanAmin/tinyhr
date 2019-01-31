<?php
if(isset($_POST['login']) && !empty($_POST['username'])  && !empty($_POST['password'])){
    $db= new MysqlHandler("members");
    $db->connect();
    //    $sql = "SELECT username, password FROM members WHERE username = ".$_POST['username'];
    $sql_query = "SELECT id,username, password FROM members WHERE username = '".$_POST['username']."' ";
    $res = $db->get_results($sql_query);
    
    echo $hashed_from_db."<br>";
    echo hash('sha256',$_POST['password'])."<br>";
    
    if(trim( $res[0]['password']) === trim(hash('sha256',$_POST['password']))){
        $_SESSION['is_admin'] = ($_POST['username'] === "admin")? true : false;
        $_SESSION['user_id'] = $res[0]['id'];
        header("refresh:0");
    }
    else{
        echo"username and password do not match";
    }
}
else{ 
    if(isset($_POST['signup'])) {
        require_once'signup.php';
        die();
    }
}


//echo"please enter valid input";
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <div align = "center">
            <div style = "width:300px; border: solid 1px #333333; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>	
                <div style = "margin:30px">
                    <form action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post">
                        <label>UserName  :</label><input type = "text" name = "username" class = "box" placeholder="Enter your Name" /><br /><br />
                        <label>Password  :</label><input type = "password" name = "password" class = "box" placeholder="Enter your PassWord" /><br/><br />
                        <button  type = "submit" name = "login" >Login</button><br />
                        <button type = "submit" name = "signup" >Sign up</button><br />


                        <!--<input type = "submit"  value = "LOG IN"/><br />-->
                    </form>	
                </div>				
            </div>	
        </div>
    </body>
</html>