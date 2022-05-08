<style>
    <?php include("style/post.css"); ?>
</style>


<?php
$check_if_like = "Select * from likes where user_id='$current_user_id' and post_id='$post_id'";
$run_check = mysqli_query($con, $check_if_like);
$likes_query = "Select * from likes where post_id='$post_id'";
$run_no = mysqli_query($con, $likes_query);
$no_of_likes = mysqli_num_rows($run_no);


$liked = false;
if (mysqli_num_rows($run_check) > 0) {
    $liked = true;
} else {
    $liked = false;
}

echo $liked ? "<i class='bi bi-heart-fill' id='likeIcon2' onclick='toggleIcon()'></i>" : "<i class='bi bi-heart' id='likeIcon1' onclick='toggleIcon()'></i>";
echo $no_of_likes>1?"<span class='postLikeCounter'>" . $no_of_likes." likes</span>":"<span class='postLikeCounter'>" . $no_of_likes." like</span>";

?>


<script>
    let $post_id = <?php echo $post_id ?>;
    let $current_user_id = <?php echo $current_user_id ?>;


    function toggleIcon() {

        $('#likeIcon2').toggleClass("bi bi-heart-fill bi bi-heart");
        $('#likeIcon1').toggleClass("bi bi-heart  bi bi-heart-fill");
        if ($('#likeIcon1').hasClass("bi bi-heart")) {

            function unlike() {
                var request = new XMLHttpRequest();
                request.open("GET", "functions/unlike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            unlike();

        }

        if ($('#likeIcon1').hasClass("bi bi-heart-fill")) {

            function like() {
                var request = new XMLHttpRequest();
                request.open("GET", "functions/like.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            like();

        }

        if ($('#likeIcon2').hasClass("bi bi-heart-fill")) {

            function like() {
                var request = new XMLHttpRequest();
                request.open("GET", "functions/like.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            like();
            

        }

        if ($('#likeIcon2').hasClass("bi bi-heart")) {

            function unlike() {
                var request = new XMLHttpRequest();
                request.open("GET", "functions/unlike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            unlike();

        }
    }

</script>