<?php 
require_once('../../includes/load.php');
$user = current_user();

if($user['theme'] == 'light'){
    $query = "UPDATE users SET theme = 'dark' WHERE id = '".$user['id']."'";
}else{
    $query = "UPDATE users SET theme = 'light' WHERE id = '".$user['id']."'";
}
$db->query($query);
?>
