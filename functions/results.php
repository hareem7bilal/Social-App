<style>
    <?php include("style/post.css"); ?>
</style>


<?php
include("includes/connection.php");
include("functions/timeago.php");
function results()
{

    global $con;
    $email = $_SESSION['email'];

    $get_current_user = "select * from users where email='$email'";
    $run_user = mysqli_query($con, $get_current_user);
    $row_user = mysqli_fetch_array($run_user);
    $current_user_id = $row_user['user_id'];

    if (isset($_GET['search'])) {
        $search_query = htmlentities($_GET['user_query']);
    }
    $get_posts = "select * from posts where content like '%$search_query%' OR image like '%$search_query%'";
    $run_posts = mysqli_query($con, $get_posts);
    if (mysqli_num_rows($run_posts) > 0) {
        while ($row_post = mysqli_fetch_array($run_posts)) {
            $user_id = $row_post['user_id'];
            $post_id = $row_post['post_id'];
            $content = $row_post['content'];
            $image = $row_post['image'];
            $date = $row_post['date'];

            $get_user = "select * from users where user_id like '$user_id' and posts='yes'";
            $run_user = mysqli_query($con, $get_user);
            $row_user = mysqli_fetch_array($run_user);
            $username = $row_user['username'];
            $profile_pic = $row_user['profile_pic'];

            $likes_query = "Select * from likes where post_id='$post_id'";
            $run_no = mysqli_query($con, $likes_query);
            $no_of_likes = mysqli_num_rows($run_no);

            $dislikes_query = "Select * from dislikes where post_id='$post_id'";
            $run_no = mysqli_query($con, $dislikes_query);
            $no_of_dislikes = mysqli_num_rows($run_no);


            if ($content == "" && strlen($image) >= 1) {
                echo "
        <div class='post' style='width:55%; margin-left:25%'>
<div class='postWrapper'>
    <div class='postTop'>
        <div class='postTopLeft'>";
                if ($user_id == $current_user_id) {
                    echo "<a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>";
                } else {
                    echo "<a href='user_profile.php?user_id= $user_id'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>";
                }
                echo "<span class='postUserName'>$username</span>
            <span class='postDate'>";
                timeago(date($date));
                echo "</span>
        </div>
        <div class='postTopRight'>
        <div class='dropdown' >
        <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
        <ul class='dropdown-menu ' id='d-menu-home'>
        ";

                if ($user_id == $current_user_id) {
                    echo "
            <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
            Delete</button></a></li>
            <li class='divider'></li>
<li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
Edit</button></a></li>
<li class='divider'></li>     
       ";
                }

                echo "
        <li><a href='singlePost.php?post_id=$post_id'><button name='viewpost' id='view' class='btn btn-success'><i class='bi bi-eye-fill'></i>
        View</button></a></li>
        </ul>
        </div>
        </div>
    </div>
    <div class='postCenter'>
        <img src='$image' alt='post pic' class='postImg' />
    </div>
    <div class='postBottom'>
        <div class='postBottomLeft'>
        <span class='postLikeCounter'>$no_of_likes</span>&nbsp;
        <i class='bi bi-heart-fill' id='likeIcon2'></i>&nbsp;&nbsp;
        <span class='postLikeCounter'>$no_of_dislikes</span>&nbsp;
        <i class='bi bi-hand-thumbs-down-fill' id='likeIcon2'></i>


        </div>
        <div class='postBottomRight'>
        <a href='singlePost.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
        </div>
    </div>
</div>
</div>
        ";
            } else if ($content >= 1 && strlen($image) >= 1) {
                echo "
        <div class='post' style='width:55%; margin-left:25%'>
<div class='postWrapper'>
    <div class='postTop'>
        <div class='postTopLeft'>";
                if ($user_id == $current_user_id) {
                    echo "<a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>";
                } else {
                    echo "<a href='user_profile.php?user_id= $user_id'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>";
                }
                echo "<span class='postUserName'>$username</span>
            <span class='postDate'>";
                timeago(date($date));
                echo "</span>
        </div>
        <div class='postTopRight'>
        <div class='dropdown' >
        <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
        <ul class='dropdown-menu ' id='d-menu-home'>
        ";

                if ($user_id == $current_user_id) {
                    echo "
            <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
            Delete</button></a></li>
            <li class='divider'></li>
<li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
Edit</button></a></li>
<li class='divider'></li>     
       ";
                }

                echo "  
        <li><a href='singlePost.php?post_id=$post_id'><button name='viewpost' id='view' class='btn btn-success'><i class='bi bi-eye-fill'></i>
        View</button></a></li>
        </ul>
        </div>
        </div>
    </div>
    <div class='postCenter'>
        <span class='postText'>$content</span>
        <img src='$image' alt='post pic' class='postImg' />
    </div>
    <div class='postBottom'>
        <div class='postBottomLeft'>
        <span class='postLikeCounter'>$no_of_likes</span>&nbsp;
        <i class='bi bi-heart-fill' id='likeIcon2'></i>&nbsp;&nbsp;
        <span class='postLikeCounter'>$no_of_dislikes</span>&nbsp;
        <i class='bi bi-hand-thumbs-down-fill' id='likeIcon2'></i>

        </div>
        <div class='postBottomRight'>
        <a href='singlePost.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
        </div>
    </div>
</div>
</div>
        ";
            } else {
                echo "
        <div class='post' style='width:55%; margin-left:25%'>
<div class='postWrapper'>
    <div class='postTop'>
        <div class='postTopLeft'>";
                if ($user_id == $current_user_id) {
                    echo "<a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>";
                } else {
                    echo "<a href='user_profile.php?user_id= $user_id'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>";
                }
                echo "<span class='postUserName'>$username</span>
            <span class='postDate'>";
                timeago(date($date));
                echo "</span>
        </div>
        <div class='postTopRight'>
        <div class='dropdown' >
        <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
        <ul class='dropdown-menu ' id='d-menu-home'>
        ";

                if ($user_id == $current_user_id) {
                    echo "
            <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
            Delete</button></a></li>
            <li class='divider'></li>
<li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
Edit</button></a></li>
<li class='divider'></li>     
       ";
                }


                echo "
        <li><a href='singlePost.php?post_id=$post_id'><button name='viewpost' id='view' class='btn btn-success'><i class='bi bi-eye-fill'></i>
        View</button></a></li>
        </ul>
        </div>
        </div>
    </div>
    <div class='postCenter'>
        <span class='postText'>$content</span>
    </div>
    <div class='postBottom'>
        <div class='postBottomLeft'>
        <span class='postLikeCounter'>$no_of_likes</span>&nbsp;
        <i class='bi bi-heart-fill' id='likeIcon2'></i>&nbsp;&nbsp;
        <span class='postLikeCounter'>$no_of_dislikes</span>&nbsp;
        <i class='bi bi-hand-thumbs-down-fill' id='likeIcon2'></i>

        </div>
        <div class='postBottomRight'>
        <a href='singlePost.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
        </div>
    </div>
</div>
</div>
        ";
            }
        }
    }
    else{
        echo "<div class='noResultText'>Not Found</div>";
    }
}
?>