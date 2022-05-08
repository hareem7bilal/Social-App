<style>
  <?php include("style/post.css"); ?>
</style>


<?php
$check_if_dislike = "Select * from dislikes where user_id='$current_user_id' and post_id='$post_id'";
$run_check2 = mysqli_query($con, $check_if_dislike);
$dislikes_query = "Select * from dislikes where post_id='$post_id'";
$run_no = mysqli_query($con, $dislikes_query);
$no_of_dislikes = mysqli_num_rows($run_no);


$disliked = false;
if (mysqli_num_rows($run_check2) > 0) {
  $disliked = true;
} else {
  $disliked = false;
}

echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo $disliked ? "<i class='bi bi-hand-thumbs-down-fill' id='dislikeIcon2' onclick='secondtoggleIcon()'></i>" : "<i class='bi bi-hand-thumbs-down' id='dislikeIcon1' onclick='secondtoggleIcon()'></i>";
echo $no_of_dislikes>1?"<span class='postLikeCounter'>" . $no_of_dislikes." dislikes</span>":"<span class='postLikeCounter'>" . $no_of_dislikes." dislike</span>";

?>


<script>
  function secondtoggleIcon() {

    $('#dislikeIcon2').toggleClass("bi bi-hand-thumbs-down-fill bi bi-hand-thumbs-down");
    $('#dislikeIcon1').toggleClass("bi bi-hand-thumbs-down bi bi-hand-thumbs-down-fill");


    if ($('#dislikeIcon1').hasClass("bi bi-hand-thumbs-down")) {

      function undislike() {
        var request = new XMLHttpRequest();
        request.open("GET", "functions/undislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      undislike();

    }

    if ($('#dislikeIcon1').hasClass("bi bi-hand-thumbs-down-fill")) {

      function dislike() {
        var request = new XMLHttpRequest();
        request.open("GET", "functions/dislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      dislike();

    }

    if ($('#dislikeIcon2').hasClass("bi bi-hand-thumbs-down-fill")) {

      function dislike() {
        var request = new XMLHttpRequest();
        request.open("GET", "functions/dislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      dislike();

    }

    if ($('#dislikeIcon2').hasClass("bi bi-hand-thumbs-down")) {

      function undislike() {
        var request = new XMLHttpRequest();
        request.open("GET", "functions/undislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      undislike();

    }
  }
</script>