<?php
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





<div>
    <div>
        <a class="button" href="<?php echo "?start=".$prev_index;?>" >prev  </a>

        <a class="button" href="<?php echo "?start=".$next_index;?>" >next </a>
    </div>
    <br>
    <table id="users" border = 1px >
        <tr>
            <th> Name </th>
            <th> Job </th>
            <th> More Info </th>
        </tr>
        <?php foreach($members as $member){?> 
        <tr>
            <td> <?php echo $member['fullname'];?></td>
            <td> <?php echo $member['job'];?> </td>

            <td><a  href="<?php echo "?user_id=". $member['id']."&hist=".$start_index;?>">more</a></td>
        </tr>
        <?php }?>
    </table>

</div>
