<?php
 
if (isset($_GET['post_id'])&&isset($_GET['current_user_id'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
    $post_id = $_GET['post_id'];
    $current_user_id=$_GET['current_user_id'];
    $remove_dislike = "delete from dislikes where user_id='$current_user_id' and post_id='$post_id'";
    $run_remove = mysqli_query($con, $remove_dislike);
   
}
?>
