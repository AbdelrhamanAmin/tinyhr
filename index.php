<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("autoload.php");
define("_ALLOW_ACCESS", 1);
session_start();
session_regenerate_id();
// admin/user, admin/users, member/edit , member/profile , public/signup, public/login index.php
//********************************************//

if(isset($_GET['logout']) && isset($_SESSION['user_id'])){
    // var_dump($_SESSION);
    session_destroy();
    $_GET=[];
    header('Refresh:0');
}
    // Routing 
    if (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] == '1') {
        //admin views should be required here
        $page = 'admin/';
        $page  .= isset($_GET['id']) ? "user": "users";

    } elseif (isset($_SESSION["user_id"]) && $_SESSION["is_admin"] === '0') {
        //members views should be required here
        $page = 'member/';
        $page  .= isset($_GET['edit']) ? "edit" : "profile";

    } else{
        //public views should be required here
        $page = 'public/';

        if(isset($_GET['signup']) || isset($_POST['signup'])){
            $page .= 'signup';
        }
        else{
            $page .='login';
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
</head>
<body>
  
    <header>
        <hr>
        <center><h1>Top Stuff
        <?php
            if(isset($_SESSION['user_id'])){?>
                <h6 ALIGN=RIGHT>
                    <a  href="?logout"> Logout</a>
            </h6>
           <?php }?>
           </h1></center>
        <hr>
    </header>
<center>    <div class="content">
        <?php 

        require_once './Views/'.$page. '.php';    
        ?>
      
    </div><center>

    <footer>
        <hr>
        <center><h1>Bottom Stuff</h1></center>
        <hr>
    </footer>


</body>
</html>