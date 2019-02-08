<?php
echo "View Profile Page";

$db = new MySQLHandler('members');
$user = $db->get_record_by_id($_SESSION['user_id'])[0];

echo '<pre>' . var_export($user, true) . '</pre>';
?>

<div>
    // Put LOGIC OF PROFILE HERE 
    
    
    
    
</div>
