<?php
$con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $delete_post = "delete from posts where post_id='$post_id'";
    $delete_comments = "delete from comments where post_id='$post_id'";
    $run_delete_post = mysqli_query($con, $delete_post);
    $run_delete_comments = mysqli_query($con, $delete_comments);
    if ($run_delete_post&&$run_delete_comments) {
        echo "<script>window.open('../profile.php','_self')</script>";
    }
}
?>