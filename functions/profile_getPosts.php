<style>
    <?php include("style/post.css"); ?>
</style>

<?php
include("includes/connection.php");
include("functions/timeago.php");

function profile_getPosts()
{
    global $con;

    $get_posts = "select * from posts ORDER by 4 DESC";
    $run_get_posts = mysqli_query($con, $get_posts);
    while ($row_post = mysqli_fetch_array($run_get_posts)) {
        $user_id = $row_post['user_id'];
        $post_id = $row_post['post_id'];
        $content = $row_post['content'];
        $image = $row_post['image'];
        $date = $row_post['date'];
        $get_users = "select * from users where user_id='$user_id' AND posts='yes'";
        $run_get_users = mysqli_query($con, $get_users);
        $row_user = mysqli_fetch_array($run_get_users);
        $username = $row_user['username'];
        $profile_pic= $row_user['profile_pic'];

    
        if($content=="" && strlen($image)>=1){
            echo "
            <div class='post'>
    <div class='postWrapper'>
        <div class='postTop'>
            <div class='postTopLeft'>
                <a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>
                <span class='postUserName'>$username</span>
                <span class='postDate'>";
                timeago(date($date));
            echo "</span>
            </div>
            <div class='postTopRight'>
            <div class='dropup'>
            <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
            <ul class='dropdown-menu ' id='d-menu'>
            <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
            Delete</button></a></li>
            <li class='divider'></li>
            <li><a href='singlePost.php?post_id=$post_id'><button name='viewpost' id='view' class='btn btn-success'><i class='bi bi-eye-fill'></i>
            View</button></a></li>
            <li class='divider'></li>
            <li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
            Edit</button></a></li>
            </ul>
        </div>
            </div>
        </div>
        <div class='postCenter'>
            <img src='$image' alt='post pic' class='postImg' />
        </div>
        <div class='postBottom'>
            <div class='postBottomLeft'>
                <i class='bi bi-heart-fill' id='likeIcon1'></i> 
                <i class='bi bi-hand-thumbs-up-fill' id='likeIcon2'></i>&nbsp;
                <span class='postLikeCounter'>0 people like it</span>
            </div>
            <div class='postBottomRight'>
            <a href='singlePost.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
            </div>
        </div>
    </div>
</div>
            ";
        }
        else if($content>=1 && strlen($image)>=1){
            echo "
            <div class='post'>
    <div class='postWrapper'>
        <div class='postTop'>
            <div class='postTopLeft'>
                <a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>
                <span class='postUserName'>$username</span>
                <span class='postDate'>";
                timeago(date($date));
            echo "</span>
            </div>
            <div class='postTopRight'>
            <div class='dropup'>
            <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
            <ul class='dropdown-menu ' id='d-menu'>
            <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
            Delete</button></a></li>
            <li class='divider'></li>
            <li><a href='singlePost.php?post_id=$post_id'><button name='viewpost' id='view' class='btn btn-success'><i class='bi bi-eye-fill'></i>
            View</button></a></li>
            <li class='divider'></li>
            <li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
            Edit</button></a></li>
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
                <i class='bi bi-heart-fill' id='likeIcon1'></i> 
                <i class='bi bi-hand-thumbs-up-fill' id='likeIcon2'></i>&nbsp;
                <span class='postLikeCounter'>0 people like it</span>
            </div>
            <div class='postBottomRight'>
            <a href='singlePost.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
            </div>
        </div>
    </div>
</div>
            ";
        }
        else{
            echo "
            <div class='post'>
    <div class='postWrapper'>
        <div class='postTop'>
            <div class='postTopLeft'>
                <a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>
                <span class='postUserName'>$username</span>
                <span class='postDate'>";
                timeago(date($date));
               echo "</span>
            </div>
            <div class='postTopRight'>
            <div class='dropup'>
            <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
            <ul class='dropdown-menu ' id='d-menu'>
            <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
            Delete</button></a></li>
            <li class='divider'></li>
            <li><a href='singlePost.php?post_id=$post_id'><button name='viewpost' id='view' class='btn btn-success'><i class='bi bi-eye-fill'></i>
            View</button></a></li>
            <li class='divider'></li>
            <li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
            Edit</button></a></li>
            </ul>
        </div>
            </div>
        </div>
        <div class='postCenter'>
            <span class='postText'>$content</span>
        </div>
        <div class='postBottom'>
            <div class='postBottomLeft'>
                <i class='bi bi-heart-fill' id='likeIcon1'></i> 
                <i class='bi bi-hand-thumbs-up-fill' id='likeIcon2'></i>&nbsp;
                <span class='postLikeCounter'>0 people like it</span>
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
include("deletePost.php");
?>