<html>
<?php
session_start();
include("includes/topbar.php");
include("functions/timeago.php");

if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}
if ($user_id == "" || $user_id < 0) {
    echo "<script>window.open('home.php','_self')</script>";
} else {
    $select_user = "select * from users where user_id='$user_id'";
    $run_user = mysqli_query($con, $select_user);
    $row_user = mysqli_fetch_array($run_user);
    $username = $row_user['username'];
    $first_name = $row_user['first_name'];
    $last_name = $row_user['last_name'];
    $email = $row_user['email'];
    $country = $row_user['country'];
    $gender = $row_user['gender'];
    $birthday = $row_user['birthday'];
    $profile_pic = $row_user['profile_pic'];
    $cover_pic = $row_user['cover_pic'];
    $registeration_date = $row_user['registration_date'];
    $description = $row_user['description'];

    $email = $_SESSION['email'];
    $get_current_user = "select * from users where email='$email'";
    $run_user = mysqli_query($con, $get_current_user);
    $row_user = mysqli_fetch_array($run_user);
    $current_user_id = $row_user['user_id'];
}
?>

<head>
    <title>Utopia Profile:&nbsp;<?php echo "$username"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/post.css">
    <link rel="stylesheet" href="style/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/cute-alert.js"></script>
</head>

<body>
    <div class="profile">
        <div class="profileRight">
            <div class="profileRightTop">
                <div class="profileCover">
                    <img src=<?php echo "'$cover_pic'" ?> alt="cover photo" class="profileCoverImg" />
                    <img src=<?php echo "'$profile_pic'" ?> alt="user photo" class="profileUserImg" />

                </div>

                <div class="profileInfo">
                    <h4 class="profileUserName"><?php echo "$first_name $last_name" ?></h4>
                    <span class="profileDesc"><?php echo "$description" ?></span>
                </div>


            </div>


            <div class="profileRightBottom">
                <div style="flex:8.5;padding:0 50px 0 30px;">
                    <?php
                    $get_posts = "Select * from posts where user_id='$user_id' ORDER BY 4 DESC";
                    $run_get_posts = mysqli_query($con, $get_posts);
                    $check_followers = "select * from followers where user_id='$current_user_id'";
                    $run_check = mysqli_query($con, $check_followers);
                    $is_follower = true;
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
                   

                        while ($row_post = mysqli_fetch_array($run_get_posts)) {
                            $post_id = $row_post['post_id'];
                            $content = $row_post['content'];
                            $image = $row_post['image'];
                            $date = $row_post['date'];

                            $likes_query = "Select * from likes where post_id='$post_id'";
                            $run_no = mysqli_query($con, $likes_query);
                            $no_of_likes = mysqli_num_rows($run_no);

                            $dislikes_query = "Select * from dislikes where post_id='$post_id'";
                            $run_no = mysqli_query($con, $dislikes_query);
                            $no_of_dislikes = mysqli_num_rows($run_no);




                            if ($content == "" && strlen($image) >= 1) {
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
<div class='dropdown'>
<button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
<ul class='dropdown-menu ' id='d-menu'>
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
                            } else if (strlen($content) >= 1 && strlen($image) >= 1) {
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
            <div class='dropdown'>
            <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
            <ul class='dropdown-menu ' id='d-menu'>
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
            <div class='postTopLeft'>
                <a href='profile.php'><img src='$profile_pic' alt='profile pic' class='postProfileImg' /></a>
                <span class='postUserName'>$username</span>
                <span class='postDate'>";
                                timeago(date($date));
                                echo "</span>
            </div>
            <div class='postTopRight'>
            <div class='dropdown'>
            <button class='btn btn-default dropdown-toggle' type='button' id='menu1' data-toggle='dropdown'><i class='bi bi-three-dots-vertical' id='likeIcon'></i></button>
            <ul class='dropdown-menu ' id='d-menu'>
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
                   







                    echo '</div>
                <div class="rightbar">
                    <div class="rightbarWrapper">';





                    echo '<button type="button" class="btn btn-success" style=';
                    echo   $is_follower ? '"background-color:darkred"' : '"background-color:green"';
                    echo 'id="follow">';

                    echo  $is_follower ? 'Unfollow<i class="bi bi-dash"></i>' : 'Follow<i class="bi bi-plus"></i>';

                    echo '</button><br /><br /><br />';

                    echo '
                        <h4 class="rightbarTitle">About</h4>
                        <hr>
                        <div class="rightbarInfo">
                            <div class="rightbarInfoItem">
                                <span class="rightbarInfoKey">Gender:</span>
                                <span class="rightbarInfoValue">' . $gender . '</span>
                            </div>
                            <div class="rightbarInfoItem">
                                <span class="rightbarInfoKey">Birthday:</span>
                                <span class="rightbarInfoValue">' . $birthday . '</span>
                            </div>
                            <div class="rightbarInfoItem">
                                <span class="rightbarInfoKey">Relationship Status:</span>
                                <span class="rightbarInfoValue">' . $relationship_status . '</span>
                            </div>
                            <div class="rightbarInfoItem">
                                <span class="rightbarInfoKey">Country:</span>
                                <span class="rightbarInfoValue">' . $country . '</span>
                            </div>
                            <div class="rightbarInfoItem" >
                                <span class="rightbarInfoKey">Member since:</span>
                                <span class="rightbarInfoValue">' . $registeration_date . '</span>
                            </div>
                            <h4 class="rightbarTitle" id="friends">Friends</h4>
                            <hr>
                            <div class="leftbarFriendList">';


                    $get_friends = "select * from followers where user_id='$user_id'";
                    $run_friends = mysqli_query($con, $get_friends);


                    while ($row = mysqli_fetch_array($run_friends)) {
                        $friend_id = $row['friend_id'];
                        $get_friend = "select * from users where user_id='$friend_id'";
                        $run_friend = mysqli_query($con, $get_friend);
                        $row_friend = mysqli_fetch_array($run_friend);
                        $first_name = $row_friend['first_name'];
                        $last_name = $row_friend['last_name'];
                        $profile_pic = $row_friend['profile_pic'];


                        echo "
                <div class='leftbarListItem'>
                <a href='user_profile.php?user_id= $friend_id'>
                <img src='$profile_pic' id='friend_img' width='80px' height='80px'/>
                </a>
                <h4>$first_name $last_name</h4>
                </div>
                ";
                    }
                    echo '
                            </div>
                        </div>' ?>
                </div>
            </div>

        </div>
    </div>
    </div>



    <script>
        let $user_id = <?php echo $user_id ?>;

        let $current_user_id = <?php echo $current_user_id ?>;


        $(document).ready(function() {


            if ($("#follow").html() == 'Follow<i class="bi bi-plus"></i>') {
                $('.rightbarTitle').hide();
                $('.rightbarInfo').hide();
                $('hr').hide();
                $('.post').hide();
            } else {
                $('.rightbarTitle').show();
                $('.rightbarInfo').show();
                $('hr').show();
                $('.post').show();
            }

            $("#follow").click(function() {
                if ($(this).html() == 'Follow<i class="bi bi-plus"></i>') {
                    $(this).html('Unfollow<i class="bi bi-dash"></i>');
                    $('.rightbarTitle').show();
                    $('.rightbarInfo').show();
                    $('hr').show();
                    $('.post').show();
                    $(this).css("background-color", "darkred");


                    function follow() {
                        var request = new XMLHttpRequest();
                        request.open("GET", "functions/follow.php?user_id=" + $user_id + "&current_user_id=" + $current_user_id);
                        request.send();
                    }
                    follow();
                    cuteToast({
                        type: 'success',
                        title: 'Success!',
                        message: 'User has been followed.'
                    });

                } else {
                    $(this).html('Follow<i class="bi bi-plus"></i>');
                    $('.rightbarTitle').hide();
                    $('.rightbarInfo').hide();
                    $('hr').hide();
                    $('.post').hide();
                    $(this).css("background-color", "green");

                    function unfollow() {
                        var request = new XMLHttpRequest();
                        request.open("GET", "functions/unfollow.php?user_id=" + $user_id + "&current_user_id=" + $current_user_id);
                        request.send();
                    }
                    unfollow();
                    cuteToast({
                        type: 'error',
                        title: 'Success!',
                        message: 'User has been unfollowed.'
                    });

                }
            });

        });
    </script>
</body>

</html>