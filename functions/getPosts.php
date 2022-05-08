<style>
    <?php include("style/post.css"); ?>
</style>

<?php
include("includes/connection.php");
include("functions/timeago.php");


$email = $_SESSION['email'];

function getPosts()
{
    global $con, $email;
    $per_page = 4;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $get_current_user = "select * from users where email='$email'";
    $run_user = mysqli_query($con, $get_current_user);
    $row_user = mysqli_fetch_array($run_user);
    $current_user_id = $row_user['user_id'];


    $start_from = ($page - 1) * $per_page;
    $get_posts = "select * from posts ORDER by 4 DESC LIMIT $start_from,$per_page";
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



        $likes_query = "Select * from likes where post_id='$post_id'";
        $run_no = mysqli_query($con, $likes_query);
        $no_of_likes = mysqli_num_rows($run_no);

        $dislikes_query = "Select * from dislikes where post_id='$post_id'";
        $run_no = mysqli_query($con, $dislikes_query);
        $no_of_dislikes = mysqli_num_rows($run_no);

        $check_followers = "select * from followers where user_id='$current_user_id'";
        $run_check = mysqli_query($con, $check_followers);
        $is_follower = false;
        if (mysqli_num_rows($run_check) == 0) {
            $is_follower = false;
        } else {
            while ($row = mysqli_fetch_array($run_check)) {
                $friend_id = $row['friend_id'];
                if ($user_id == $friend_id) {
                    $is_follower = true;
                    break;
                }
            }
        }


        if ($is_follower || ($user_id == $current_user_id)) {

            if ($content == "" && strlen($image) >= 1) {
                echo "
            <div class='post'>
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
            echo"</span>
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
            <div class='post'>
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
                echo"</span>
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
            <div class='post'>
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
    include("pagination.php");
}

function single_post()
{
    global $con;
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $get_post = "select * from posts where post_id='$post_id'";
        $run_get = mysqli_query($con, $get_post);
        $row = mysqli_fetch_array($run_get);
        $content = $row['content'];
        $image = $row['image'];
        $user_id = $row['user_id'];
        $date = $row['date'];
        $user = "select * from users where user_id='$user_id' and posts='yes'";
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);
        $username = $row_user['username'];
        $profile_pic = $row_user['profile_pic'];
        global $email;
        $get_current_user = "select * from users where email='$email'";
        $run_user = mysqli_query($con, $get_current_user);
        $row_user = mysqli_fetch_array($run_user);
        $current_user_id = $row_user['user_id'];
        $current_username = $row_user['username'];
        $current_profile_pic = $row_user['profile_pic'];

        $get_post_id = "select post_id from posts where post_id='$post_id'";
        $run_user = mysqli_query($con, $get_post_id);
        $post_id = $_GET['post_id'];
        $get_user = "select * from posts where post_id='$post_id'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        $p_id = $row['post_id'];
        if ($p_id != $post_id) {
            echo "<script>alert('Error')</script>";
            echo "<script>window.open('home.php','_self')</script>";
        } else {
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
                echo "
                    <span class='postUserName'>$username</span>
                    <span class='postDate'>";
                    timeago(date($date));
                    echo "</span>
                </div>";

                if ($user_id == $current_user_id) {
                    echo "
                    <div class='postTopRight'>
                    <div class='dropdown' >
                    <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
                    <ul class='dropdown-menu ' id='d-menu'>
                    <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
                    Delete</button></a></li>
                    <li class='divider'></li>
        <li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
        Edit</button></a></li>
        </ul>
        </div>
        </div>
               ";
                }

                echo "
            </div>
            <div class='postCenter'>
                <img src='$image' alt='post pic' class='postImg' />
            </div>
            <div class='postBottom'>
                <div class='postBottomLeft'>";
                include("includes/like.php");
                include("includes/dislike.php");

                echo "</div>
            </div>
        </div>
    </div>
                ";
            } else if ($content >= 1 && strlen($image) >= 1) {
                echo "
                <div class='post'style='width:55%; margin-left:25%'>
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
                </div>";

                if ($user_id == $current_user_id) {
                    echo "
                    <div class='postTopRight'>
                    <div class='dropdown' >
                    <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
                    <ul class='dropdown-menu ' id='d-menu'>
                    <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
                    Delete</button></a></li>
                    <li class='divider'></li>
        <li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
        Edit</button></a></li>
        </ul>
        </div>
        </div>
               ";
                }


                echo "
                </div>
            <div class='postCenter'>
                <span class='postText'>$content</span>
                <img src='$image' alt='post pic' class='postImg' />
            </div>
            <div class='postBottom'>
                <div class='postBottomLeft'>";
                include("includes/like.php");
                include("includes/dislike.php");
                echo "</div>
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
                </div>";

                if ($user_id == $current_user_id) {
                    echo "
                    <div class='postTopRight'>
                    <div class='dropdown' >
                    <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
                    <ul class='dropdown-menu ' id='d-menu'>
                    <li ><a href='functions/deletePost.php?post_id=$post_id'><button name='deletepost' id='delete' class='btn btn-danger'><i class='bi bi-trash-fill'></i>
                    Delete</button></a></li>
                    <li class='divider'></li>
        <li><a href='edit_post.php?post_id=$post_id'><button name='editpost' id='edit' class='btn btn-info'><i class='bi bi-pencil-fill'></i>
        Edit</button></a></li>
        </ul>
        </div>
        </div>
               ";
                }

                echo "
                </div>
            <div class='postCenter'>
                <span class='postText'>$content</span>
            </div>
            <div class='postBottom'>
                <div class='postBottomLeft'>";
                include("includes/like.php");
                include("includes/dislike.php");
                echo "</div>
            </div>
        </div>
    </div>
                ";
            }

            echo "
            <div class='post' style='width:55%; margin-left:25%'>
            <div class='postWrapper'>
            <div class='postTop' >
            <form method='post' id='contactForm' name='contactForm'>
            <div class='row'>
            <div class='col-md-12 form-group' id='commentInput'>
              <textarea  id='comment_textarea' class='form-control' name='comment' cols='85' rows='5' placeholder='Add your comment!'></textarea>
            </div>
                <button class='btn btn-info pull-right' id='comment' name='send'>Comment</button>
              </div>
            </form>
          
            </div> 
                </div>
                </div>
                <script>
                $(document).ready(function() {
                    $('#comment_textarea').emojioneArea({
                        pickerPosition: 'bottom'
                    });
    
                });
                </script>
                
            ";
           



            if (isset($_POST['send'])) {
                $comment = htmlentities($_POST['comment']);

                if ($comment == "") {
                    echo "<script>
                cuteToast({
                    type: 'warning',
                    title: 'Warning',
                    message: 'Empty comment.',
                  })
                  </script>";
                } else {
                    $insert_comment = "insert into comments(post_id,user_id,comment,author,date) values('$post_id','$user_id',' $comment','$current_username',NOW())";
                    $run_insert = mysqli_query($con, $insert_comment);
                    if($run_insert){
                        echo "<script>
                        cuteToast({
                            type: 'success',
                            title: 'Success!',
                            message: 'You just commented.',
                          })
                          </script>";
                    }
                }
            }
            include("comments.php");
        }
    }
}
?>