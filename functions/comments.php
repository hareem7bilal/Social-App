<?php
  $post_id = $_GET['post_id'];
  $get_comments = "select * from comments where post_id='$post_id' ORDER BY 6 DESC";
  $run_get = mysqli_query($con, $get_comments);
  while($row = mysqli_fetch_array($run_get)){
    $comment = $row['comment'];
    $author = $row['author'];
    $date = $row['date'];
    $author_profile_pic="Select * from users where username='$author'";
    $run_profile_pic = mysqli_query($con,$author_profile_pic);
    $row = mysqli_fetch_array($run_profile_pic);
    $profile_pic = $row['profile_pic'];

  

     echo "
     <div class='post' style='width:55%; margin-left:25%'>
     <div class='postWrapper'>
         <div class='postTop'>
             <div class='postTopLeft'>
             <a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>
             <span class='postUserName'><strong>$author</strong><i style='font-size:13px'> commented</i>:</span>
             </div>
             <div class='postTopRight'> 
             <span class='postDate'>";
             timeago(date($date));
             echo "</span>
             </div>
             </div>
             <div class='postCenter'>
             <span class='postText'>$comment</span>
         </div>
         </div>
         </div>
             
             
             
             
           
    ";
  }
  


?>