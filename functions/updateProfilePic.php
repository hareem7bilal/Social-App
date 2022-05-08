<?php
include("includes/connection.php");
function updateProfilePic()
{
    if (isset($_POST['submit2'])) {
        global $con;
        global $user_id;
        $profile_pic = $_FILES['profile_pic']['name'];
        $img_tmp = $_FILES['profile_pic']['tmp_name'];
        $random_number = rand(1, 100);
        if ($profile_pic == '') {
            echo "<script>alert('Please Select a Profile Image.')</script>";
            echo "<script>window.open('profile.php?user_id=$user_id','_self')</script>";
            exit();
        } else {
            move_uploaded_file($img_tmp, "users/$profile_pic.$random_number");
            $update_profile_pic = "update users set profile_pic='users/$profile_pic.$random_number' where user_id='$user_id'";
            $run_update_profile_pic = mysqli_query($con, $update_profile_pic);
            if ($run_update_profile_pic) {
                echo "<script>window.open('profile.php?user_id=$user_id','_self')</script>";
            }
        }
    }
}
