<?php
 
if (isset($_GET['user_id'])&&isset($_GET['current_user_id'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
    $user_id = $_GET['user_id'];
    $current_user_id=$_GET['current_user_id'];
    $add_follower = "insert into followers(user_id,friend_id) values('$current_user_id','$user_id')";
    $run_add = mysqli_query($con, $add_follower);
}
