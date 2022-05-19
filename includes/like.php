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

echo $liked ? "<i class='bi-heart-fill' id='likeIcon2' onclick='toggleIcon()'></i>" : "<i class='bi-heart' id='likeIcon1' onclick='toggleIcon()'></i>";
echo "<span id='likes' class='postLikeCounter'>";
echo $no_of_likes==1?$no_of_likes.' like':$no_of_likes.' likes';
echo "</span>";

?>


<script>
    let $post_id = <?php echo $post_id ?>;
    let $current_user_id = <?php echo $current_user_id ?>;
    let post_id = <?php echo $post_id ?>;

   

    function toggleIcon() {



        $('#likeIcon2').toggleClass("bi-heart-fill bi-heart");
        $('#likeIcon1').toggleClass("bi-heart  bi-heart-fill");

        if ($('#likeIcon1').hasClass("bi-heart")) {

            function unlike() {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("likes").innerHTML =
                            this.responseText;
                    }
                };
                request.open("GET", "functions/unlike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            unlike();

        }

        if ($('#likeIcon1').hasClass("bi-heart-fill")) {
            

            function like() {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("likes").innerHTML =
                            this.responseText;
                    }
                };
                request.open("GET", "functions/like.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            like();

        }

        if ($('#likeIcon2').hasClass("bi-heart-fill")) {
           
            function like() {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("likes").innerHTML =
                            this.responseText;
                    }
                };
                request.open("GET", "functions/like.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            like();


        }

        if ($('#likeIcon2').hasClass("bi-heart")) {
          
            function unlike() {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("likes").innerHTML =
                            this.responseText;
                    }
                };
                request.open("GET", "functions/unlike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
                request.send();
            }
            unlike();
        }
    }
</script>