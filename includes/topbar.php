<?php include("includes/connection.php"); ?>
<style>
    <?php include("style/topbar.scss"); ?>
</style>

<?php
$user_email = $_SESSION['email'];
$get_user = "select * from users where email='$user_email'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);
$user_id = $row['user_id'];
$username = $row['username'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$description = $row['description'];
$relationship_status = $row['relationship_status'];
$password = $row['password'];
$email = $row['email'];
$country = $row['country'];
$gender = $row['gender'];
$birthday = $row['birthday'];
$profile_pic = $row['profile_pic'];
$cover_pic = $row['cover_pic'];
$recovery_account = $row['recovery_account'];
$registeration_date = $row['registration_date'];
$posts = "select * from posts where user_id='$user_id'";
$run_posts = mysqli_query($con, $posts);
$no_of_posts = mysqli_num_rows($run_posts);
?>

<div class="topbarContainer">
    <div class="topbarLeft">
        <a href='home.php' class="logo">Utopia</a>
    </div>
    <div class="topbarCenter">
        <form class="searchbar" method="get" action="results.php">
            <button type="submit" id= "nav_search" name="search" style="color:purple;background-color:white;border:none;padding:1px;margin-left:10px">
                <i class="bi bi-search" style='font-size: 20px;'></i>
            </button>
            <input placeholder="Search for posts" class="searchInput" name="user_query"/>
        </form>
    </div>
    <div class="topbarRight">

        <div class="topbarLinks">
            <a href='home.php' class="topbarLink"><i class="bi bi-house-door" style="font-size: 20px"></i>&nbsp;Home
            </a>
            <a href='profile.php' class="topbarLink"><i class="bi bi-person-fill" style="font-size: 20px;"></i>&nbsp;Profile</span>
            </a>
            <span class="topbarLink">

                <?php echo "
                <span class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true'
                aria-expanded='false' id='navbar_link'>More&nbsp;
                <span><i class='glyphicon glyphicon-chevron-down' style='font-size: 15px;color:white'></i></span></a>
                
                <ul class='dropdown-menu'>

                <li>
                <a href='profile.php'>My Posts
                <span class='badge badge-secondary'>$no_of_posts</span></a>
                </li>

                <li>
                <a href='edit_profile.php'>Edit Account</a>
                </li>

                <li role='seperator' class='divider'></li>

                <li>
                <a href='logout.php'>Log Out</a>
                </li>

                </ul>
                </span>
                "
                ?></span>
        </div>

        <div class="topbarIcons">
            <a href="members.php" data-cooltipz-dir="bottom" aria-label="Search for people" id="topbarIconItem">
                <i class="bi bi-people-fill"   style="font-size: 22px" ></i>
            </a>

            <a href="messages.php?user_id=new" data-cooltipz-dir="bottom" aria-label="Messages" id="topbarIconItem">
                <i class="bi bi-chat-fill" style="font-size: 20px;"></i>
                <span class="topbarIconBadge">2</span>
            </a>

            <div id="topbarIconItem" data-cooltipz-dir="bottom" aria-label="Notifications">
                <i class="bi bi-bell-fill" style="font-size: 20px"></i>
                <span class="topbarIconBadge">1</span>
            </div>
        </div>
        <a href='profile.php'> <img src=<?php echo "'$profile_pic'" ?> alt='profile_pic' class="topbarImg"></a>

    </div>
</div>

