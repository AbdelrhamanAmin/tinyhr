<?php

$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];


if(isset($_POST['update'])){    
    $db = new MySQLHandler('members');
    $edited_values = array(
        "fullname"=>$_POST['fullname'],
        "job"=>$_POST['job']
        // "password"=>$_POST['passwrod'],
        // "cv"=>$_POST['cv'],
        // "photo"=>$_POST['photo']
     );

    $user = $db->update($edited_values, intval($_SESSION['user_id']) );
    header('Location: index.php');

    echo "$user";
}

?>


<h4>Edit Profile</h4>

<form   method = "post" enctype="multipart/form-data">
    <label>UserName  :</label>
    <input type = "text" name = "username" value = "<?php echo $user['username']; ?> "class = "box" placeholder="Enter your Name" /><br /><br />
    <label>Password  :</label>
    <input type = "password" name = "password" value = "" class = "box" placeholder="Enter your PassWord" /><br/><br />
    <label>Full Name  :</label>
    <input type = "text" name = "fullname" value = "<?php echo $user['fullname'];?> " class = "box" placeholder="Enter your Full Name" /><br/><br />
    <label>Job Title  :</label>
    <input type = "text" name = "job" class = "box" value = "<?php echo $user['job']; ?>" placeholder="Enter your Job Title" /><br/><br />
    <label>Upload photo</label>
    <input type="file"   name = "photo"  ><br />
    <label>Upload cv</label>
    <input type="file"  name = "cv" > <br />
    <input  type = "submit" name = "update" value="update"><br />
</form>	
