<style>
    <?php include("style/post.css"); ?>
</style>

<?php
 
if (isset($_GET['post_id'])&&isset($_GET['current_user_id'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
    $post_id = $_GET['post_id'];
    $current_user_id=$_GET['current_user_id'];
    $remove_dislike = "delete from dislikes where user_id='$current_user_id' and post_id='$post_id'";
    $run_remove = mysqli_query($con, $remove_dislike);
    $dislikes_query = "Select * from dislikes where post_id='$post_id'";
    $run_no = mysqli_query($con, $dislikes_query);
    $no_of_dislikes = mysqli_num_rows($run_no);
   
}
?>
<span class='postLikeCounter'><?php echo $no_of_dislikes==1?$no_of_dislikes." dislike":$no_of_dislikes." dislikes"?></span>