<?php

$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];

?>



        <div align = "center">
            <div style = "width:600px; border: solid 1px #333333; " align = "center">
                <div align="center" style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b><?php  echo $user['fullname']." "."Profile" ?></b></div>	
                <div style = "margin:30px">
                    <div align="right" >
                         <a  class="button" href="<?= 'cvs/'. $user['cv']; ?>" target='_blank' ><span>View CV</span></a>
                         
                    </div>
                    <div  width=300px; >
                        <p ><img src="<?php echo "photos/". $user['photo']; ?>" style="height:106px;width:106px" alt="Avatar"></p>
                        <br>
                        <strong><i >NAME : </i> <?php  echo $user['fullname']; ?></strong>
                        <br>
                        <strong><i >JOB TITLE: </i> <?php  echo $user['job']; ?></strong>
                        <br>
                        
                    </div>
                    <br>
                    <a class="button" href="?edit">Edit </a> 
                </div>
                <br>
            </div>
            <br>

        </div>
