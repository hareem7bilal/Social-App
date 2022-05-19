<?php
$con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $post_id = $_GET['post_id'];

    $delete_comment = "delete from comments where comment_id='$comment_id'";
    $run_delete = mysqli_query($con, $delete_comment);
    if ($run_delete) {
        echo "<script>window.open('../singlePost.php?post_id=$post_id','_self')</script>";
    }
}
?>