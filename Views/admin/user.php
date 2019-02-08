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

<div>
    <h4><?php echo $user['fullname'];?></h4>
    <p><?php echo $user['job'];?></p>
    <img+ src="<?php echo __PHOTOS_DIR__.$user['photo']?>">
</div>

<?php }?>
<a href="<?php echo "?start=".$_GET['hist']."&users";?>">Back</a>