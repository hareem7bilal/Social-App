<?php

if (isset($_GET['post_id']) && isset($_GET['current_user_id'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
    $post_id = $_GET['post_id'];
    $current_user_id = $_GET['current_user_id'];
    $add_dislike = "insert into dislikes(user_id,post_id) values('$current_user_id','$post_id')";
    $run_add = mysqli_query($con, $add_dislike);
   
}
?>
