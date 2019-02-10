<?php
echo "<h4>Users Page</h4>";
$db = new MySQLHandler('members');
$fields = ['id','fullname', 'job'];

if(isset($_GET['start']) ){
    $start_index = $_GET['start'];
    $prev_index = ($start_index >= __RECORDS_PER_PAGE__ )? $start_index - __RECORDS_PER_PAGE__: __FIRST_MEMBER_ID__;
    $next_index = $start_index + __RECORDS_PER_PAGE__;
}
else {
    $_GET['start'] = __FIRST_MEMBER_ID__;
    $start_index   = __FIRST_MEMBER_ID__;
    $next_index   = __FIRST_MEMBER_ID__ + __RECORDS_PER_PAGE__;
    $prev_index    = __FIRST_MEMBER_ID__;
    
}
$members = $db->get_data($fields,$start_index);

if (count($members)<__RECORDS_PER_PAGE__){
    $next_index = $next_index - __RECORDS_PER_PAGE__;
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
<style>
#users {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#users td, #users th {
  border: 1px solid #ddd;
  padding: 8px;
}

#users tr:nth-child(even){background-color: #f2f2f2;}

#users tr:hover {background-color: #ddd;}

#users th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #333333;
  color: white;
}
</style>




<div>
    <table id="users" border = 1px>
        <tr>
            <th> Name </th>
            <th> Job </th>
            <th> More Info </th>
        </tr>
        <?php foreach($members as $member){?> 
        <tr>
            <td> <?php echo $member['fullname'];?></td>
            <td> <?php echo $member['job'];?> </td>

            <td><a href="<?php echo "?user_id=". $member['id']."&hist=".$start_index;?>">more</a></td>
        </tr>
        <?php }?>

        <a href="<?php echo "?start=".$prev_index;?>" >prev </a>
        <a href="<?php echo "?start=".$next_index;?>" >next </a>

    </table>

</div>
</body>
</html>