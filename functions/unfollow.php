<?php

if (isset($_GET['user_id'])&&isset($_GET['current_user_id'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
    $user_id = $_GET['user_id'];
    $current_user_id=$_GET['current_user_id'];
    $remove_follower = "delete from followers where user_id='$current_user_id' and friend_id='$user_id'";
    $run_remove = mysqli_query($con, $remove_follower);
}
?>
