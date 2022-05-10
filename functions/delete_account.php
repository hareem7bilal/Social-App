<?php
session_start();
$con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
$email=$_SESSION['email'];

$select_user_query = "select * from users where email='$email'";
$run_select_user_query = mysqli_query($con, $select_user_query);
$check_user = mysqli_fetch_array($run_select_user_query);
$user_id = $check_user['user_id'];


session_destroy();
echo "<script>window.open('../main.php','_self')</script>";

$delete_user = "Delete from users where user_id='$user_id'";
$delete_posts = "Delete from posts where user_id='$user_id'";
$delete_likes = "Delete from likes where user_id='$user_id'";
$delete_friend = "Delete from followers where friend_id='$user_id' or user_id='$user_id'";
$delete_messages = "Delete from messages where sender_id='$user_id' or reciever_id='$user_id'";

$run_delete_user = mysqli_query($con, $delete_user);
$run_delete_posts = mysqli_query($con, $delete_posts);
$run_delete_likes = mysqli_query($con, $delete_likes);
$run_delete_friend = mysqli_query($con, $delete_friend);
$run_delete_messages = mysqli_query($con, $delete_messages);

?>