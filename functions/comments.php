<?php
  $post_id = $_GET['post_id'];
  $get_comments = "select * from comments where post_id='$post_id' ORDER BY 6 DESC";
  $run_get = mysqli_query($con, $get_comments);
  while($row = mysqli_fetch_array($run_get)){
    $comment_id = $row['comment_id'];
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
             <div class='postTopRight' style='display:flex; align-items:center' > 

             <span class='postDate' >";
             timeago(date($date));
             echo "</span>";
             
             if ($user_id == $current_user_id) {
             echo "
             <div class='dropdown'>
             <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon' style='font-size:18px'></i></button>
             <ul class='dropdown-menu ' id='d-menu'>
             <li ><a href='functions/deleteComment.php?comment_id=$comment_id&post_id=$post_id'><button name='deletecomment' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
             Delete</button></a></li>
 </ul>          
 </div>";
             }




echo "
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