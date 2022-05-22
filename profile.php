<html>
<?php
session_start();
include("includes/topbar.php");
include("functions/updateCoverPic.php");
include("functions/updateProfilePic.php");
include("functions/get_friends.php");

if (!isset($_SESSION['email'])) {
    header("location:index.php");
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
    <link rel="stylesheet" href="style/emojionearea.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/emojionearea.min.js"></script>
    <script src="style/cute-alert.js"></script>
</head>

<body>
    <div class="profile">
        <div class="profileRight">
            <div class="profileRightTop">
                <div class="profileCover">
                    <img src=<?php echo "'$cover_pic'" ?> alt="cover photo" class="profileCoverImg" />

                    <form action='profile.php?user_id=<?php echo "$user_id" ?>' method='post' enctype='multipart/form-data'>

                        <ul class='nav pull-left' style='position:absolute;top:10px;left:10px'>

                            <li class='dropdown'>
                                <button class='dropdown-toggle btn btn-default' data-toggle='dropdown' id='changeCover'>
                                    <i class='bi bi bi-camera-fill' style='font-size: 30px'></i></button>
                                <div class='dropdown-menu' id='d-menu1'>
                                    <center>
                                        <label class='btn btn-primary'>
                                            <i class='bi bi-cloud-arrow-up'></i>&nbsp;Select Cover
                                            <input name='cover_pic' type='file' />
                                        </label>
                            <li class='divider'></li>
                            <button name='submit1' id="update" class='btn btn-success'><i class='bi bi-arrow-repeat'></i>
                                Update Cover</button>
                            </center>
                </div>
                </li>
                </ul>
                </form>

                <img src=<?php echo "'$profile_pic'" ?> alt="user photo" class="profileUserImg" />
                <div id='changeprofile'>
                    <form action='profile.php?user_id=<?php echo "$user_id" ?>' method='post' enctype='multipart/form-data' style="position:relative;">

                        <ul class='nav pull-left' style='position:absolute;left:552px;top:80px'>
                            <li class='dropdown'>
                                <button class='dropdown-toggle btn btn-default' data-toggle='dropdown' id='changeProfile'>
                                    <i class='bi bi bi-camera-fill' style='font-size: 20px'></i></button>
                                <div class='dropdown-menu' id='d-menu2'>
                                    <center>
                                        <label class='btn btn-primary'>
                                            <i class='bi bi-cloud-arrow-up'></i>&nbsp;Select Profile
                                            <input name='profile_pic' type='file' />
                                        </label>
                            <li class='divider'></li>
                            <button name='submit2' id="update" class='btn btn-success'><i class='bi bi-arrow-repeat'></i>
                                Update Profile</button>
                            </center>
                </div>
                </li>
                </ul>
                </form>
            </div>
        </div>

        <div class="profileInfo">
            <h4 class="profileUserName"><?php echo "$first_name $last_name" ?></h4>
            <span class="profileDesc"><?php echo "$description" ?></span>
        </div>

        <!--update cover pic and profile pic-->
        <?php updateCoverPic();
        updateProfilePic(); ?>
    </div>


    <div class="profileRightBottom">
        <div style="flex:8.5;padding:0 50px 0 30px;">
            <?php
            include("includes/profileShare.php");
            global $con;
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
            }
            $get_posts = "Select * from posts where user_id='$user_id' ORDER BY 4 DESC";
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
                $profile_pic = $row_user['profile_pic'];

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
            include("functions/deletePost.php");

            ?>
        </div>


        <div class="rightbar">
            <div class="rightbarWrapper">
                <h4 class="rightbarTitle">About</h4>
                <hr>
                <div class="rightbarInfo">
                    <div class="rightbarInfoItem">
                        <span class="rightbarInfoKey">Gender:</span>
                        <span class="rightbarInfoValue"><?php echo "$gender" ?></span>
                    </div>
                    <div class="rightbarInfoItem">
                        <span class="rightbarInfoKey">Birthday:</span>
                        <span class="rightbarInfoValue"><?php echo "$birthday" ?></span>
                    </div>
                    <div class="rightbarInfoItem">
                        <span class="rightbarInfoKey">Relationship Status:</span>
                        <span class="rightbarInfoValue"><?php echo "$relationship_status" ?></span>
                    </div>
                    <div class="rightbarInfoItem">
                        <span class="rightbarInfoKey">Country:</span>
                        <span class="rightbarInfoValue"><?php echo "$country" ?></span>
                    </div>
                    <div class="rightbarInfoItem" style='margin-bottom:70px'>
                        <span class="rightbarInfoKey">Member since:</span>
                        <span class="rightbarInfoValue"><?php echo "$registeration_date" ?></span>
                    </div>

                    <h4 class="rightbarTitle">Friends</h4>
                    <hr>
                    <div class="leftbarFriendList">
                        <?php get_current_user_friends() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

</body>

</html>