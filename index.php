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
// 'username',$_POST['username'];


echo '<pre>' . var_export($_SESSION, true) . '</pre>';




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
        $page  .= isset($_GET['user_id']) ? "user": "users";

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
<center>
    <header>
        <hr>
            <h1>Top Stuff
                <?php
                    if(isset($_SESSION['user_id'])){?>
                        <span ALIGN=RIGHT> <a  href="?logout"> Logout</a> </span>
                <?php }?>
            </h1>
        <hr>
    </header>
    <main class="content">
            <?php require_once './Views/'.$page. '.php';    ?>
    </main>

    <footer>
        <hr>
            <h3>Bottom Stuff</h3>
        <hr>
    </footer>
</center>


</body>
</html>