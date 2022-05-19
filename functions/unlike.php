<style>
    <?php include("style/post.css"); ?>
</style>

<?php
 
if (isset($_GET['post_id'])&&isset($_GET['current_user_id'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
    $post_id = $_GET['post_id'];
    $current_user_id=$_GET['current_user_id'];
    $remove_like = "delete from likes where user_id='$current_user_id' and post_id='$post_id'";
    $run_remove = mysqli_query($con, $remove_like);
    $likes_query = "Select * from likes where post_id='$post_id'";
    $run_no = mysqli_query($con, $likes_query);
    $no_of_likes = mysqli_num_rows($run_no);
}
?>

<span class='postLikeCounter'><?php echo $no_of_likes==1?$no_of_likes." like":$no_of_likes." likes"?></span>