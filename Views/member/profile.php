<?php
echo "View Profile Page";

$db = new MySQLHandler('members');
$user = $db->get_single_record('id', $_SESSION['user_id']);

?>

<div>
    // Put LOGIC OF PROFILE HERE 
</div>
