<?php
if(isset($_POST['signup']) 
   && !empty($_POST['username'])
   && !empty($_POST['password'])
   && !empty($_POST['fullname'])
   && !empty($_POST['jobtitle'])
   && ($_FILES['photo']['size'] <__MAX_FILE_SIZE__)
   && ($_FILES['photo']['type']== ("image/jpeg")||$_FILES['photo']['type']== ("image/jpg"))
   && ($_FILES['cv']['size'] < __MAX_FILE_SIZE__)
   && $_FILES['cv']['type']== ("application/pdf")){

    $hashed_PW= hash('sha256', $_POST['password']);
    $db= new MysqlHandler("members");
    $db->connect();
    $sql_query= "INSERT INTO members(isadmin, username, password, fullname, job, photo, cv)VALUES (false,'".$_POST['username']."','". $hashed_PW."','".$_POST['fullname']."','".$_POST['jobtitle']."'
    ,'".$_FILES['photo']['name']."','".$_FILES['cv']['name']."')";


    $db->insert_data($sql_query);   
    
    
    $db= new MysqlHandler("members");
    $db->connect();
    $sql_query = "SELECT id FROM members WHERE username = '".$_POST['username']."' ";
    $res = $db->get_results($sql_query);
    $_SESSION['user_id'] = $res[0]['id'];
    $_SESSION['is_admin'] = false;
    header("refresh:0");

}


?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <div align = "center">
            <div style = "width:600px; border: solid 1px #333333; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Sign up</b></div>	
                <div style = "margin:30px">
                    <form action = "<?php echo $_SERVER['PHP_SELF'] ?> " method = "post" enctype="multipart/form-data">
                        <label>UserName  :</label><input type = "text" name = "username" class = "box" placeholder="Enter your Name" /><br /><br />
                        <label>Password  :</label><input type = "password" name = "password" class = "box" placeholder="Enter your PassWord" /><br/><br />
                        <label>Full Name  :</label><input type = "text" name = "fullname" class = "box" placeholder="Enter your Full Name" /><br/><br />
                        <label>Job Title  :</label><input type = "text" name = "jobtitle" class = "box" placeholder="Enter your Job Title" /><br/><br />
                        <label>Upload photo</label><input type="file"  name = "photo" ><br />
                        <label>Upload cv</label><input type="file"  name = "cv" > <br />
                        <input  type = "submit" name = "signup" value="Sign up"><br />
                    </form>	
                </div>				
            </div>	
        </div>
    </body>
</html>    
