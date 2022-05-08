<style>
   .leftbarListItem{
    display:flex;
    align-items:center;
    margin-bottom:20px;
}

h4{
    font-size: 16px;
    margin-left: 8px;
}

#friend_img{
    border-radius: 50px;
}
</style>

<?php
include("includes/connection.php");

function get_current_user_friends()
{
        global $con;
        $email = $_SESSION['email'];
        $get_current_user = "select * from users where email='$email'";
        $run_user = mysqli_query($con, $get_current_user);
        $row_user = mysqli_fetch_array($run_user);
        $current_user_id = $row_user['user_id'];
        $get_friends = "select * from followers where user_id='$current_user_id'";
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
            <img src='$profile_pic' id='friend_img' width='70px' height='70px'/>
            </a>
            <h4>$first_name $last_name</h4>
            </div>
            
            ";
        }

    }

    


?>
