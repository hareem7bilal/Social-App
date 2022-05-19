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
echo $disliked ? "<i class='bi-hand-thumbs-down-fill' id='dislikeIcon2' onclick='secondtoggleIcon()'></i>" : "<i class='bi-hand-thumbs-down' id='dislikeIcon1' onclick='secondtoggleIcon()'></i>";
echo "<span id='dislikes' class='postLikeCounter'>";
echo $no_of_dislikes==1?$no_of_dislikes.' dislike':$no_of_dislikes.' dislikes';
echo "</span>";

?>


<script>
  function secondtoggleIcon() {


    $('#dislikeIcon2').toggleClass("bi-hand-thumbs-down-fill bi-hand-thumbs-down");
    $('#dislikeIcon1').toggleClass("bi-hand-thumbs-down bi-hand-thumbs-down-fill");


    if ($('#dislikeIcon1').hasClass("bi-hand-thumbs-down")) {

      function undislike() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dislikes").innerHTML =
              this.responseText;
          }
        };
        request.open("GET", "functions/undislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      undislike();

    }

    if ($('#dislikeIcon1').hasClass("bi-hand-thumbs-down-fill")) {

      function dislike() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dislikes").innerHTML =
              this.responseText;
          }
        };
        request.open("GET", "functions/dislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      dislike();

    }

    if ($('#dislikeIcon2').hasClass("bi-hand-thumbs-down-fill")) {

      function dislike() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dislikes").innerHTML =
              this.responseText;
          }
        };
        request.open("GET", "functions/dislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      dislike();

    }

    if ($('#dislikeIcon2').hasClass("bi-hand-thumbs-down")) {

      function undislike() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dislikes").innerHTML =
              this.responseText;
          }
        };
        request.open("GET", "functions/undislike.php?post_id=" + $post_id + "&current_user_id=" + $current_user_id);
        request.send();
      }
      undislike();

    }
  }
</script>