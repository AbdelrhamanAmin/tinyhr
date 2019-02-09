<?php

$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];

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
                <div align="center" style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b><?php  echo $user['fullname']." "."Profile" ?></b></div>	
                <div style = "margin:30px">
                    <div align="right" >
                        <!-- <embed src="<?php echo "cvs/". $user['cv']; ?>" width="300" height="375"  type="application/pdf"> -->
                         <a href="<?= 'cvs/'. $user['cv']; ?>" target='_blank' ><span>View CV</span></a>
                         
                    </div>
                    <div  width=300px; >
                        <p ><img src="<?php echo "photos/". $user['photo']; ?>" style="height:106px;width:106px" alt="Avatar"></p>
                        <br>
                        <strong><i >NAME : </i> <?php  echo $user['fullname']; ?></strong>
                        <br>
                        <strong><i >JOB TITLE: </i> <?php  echo $user['job']; ?></strong>
                        <p><i ></i> London, UK</p>
                        <p><i ></i> April 1, 1988</p>
                        <a href="?edit">Edit </a> 
                    </div>
                </div>
                <br>
            </div>
        </div>

    </body>
</html>