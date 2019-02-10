<?php
echo "<h4>User Page</h4>";

$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_GET['user_id']);
if(!empty($user)){
    $user = $user[0];
}
else{
    echo "<h1>NO SUCH USER</h1>";
    echo "<p>PLEASE DO NOT CHANGE THE URL</p>";
    $user = null;
}

if (isset($user)){?>

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
                    </div>
                </div>
                <br>
            </div>
        </div>

    </body>
</html>

<?php }?>
<a href="<?php echo "?start=".$_GET['hist']."&users";?>">Back</a>