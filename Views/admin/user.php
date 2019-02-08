<?php

echo "User page";
$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_GET['user_id']);
if(!empty($user)){
    echo '<pre>' . var_export($user, true) . '</pre>';
    $user = $user[0];
}
else{
    echo "No Such user";
}
echo '<pre>' . var_export($_GET, true) . '</pre>';
?>

<div>
    <a href="<?php echo "?start=".$_GET['hist']."&users";?>">Back</a>
</div>