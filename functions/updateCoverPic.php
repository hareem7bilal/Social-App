<?php
include("includes/connection.php");
function updateCoverPic(){
    if (isset($_POST['submit1'])) {
        global $con;
        global $user_id;
        $cover_pic = $_FILES['cover_pic']['name'];
        $img_tmp = $_FILES['cover_pic']['tmp_name'];
        $random_number = rand(1, 100);
        if ($cover_pic == '') {
            echo "<script>alert('Please Select a Cover Image.')</script>";
            echo "<script>window.open('profile.php?user_id=$user_id','_self')</script>";
            exit();
        } else {
            move_uploaded_file($img_tmp, "cover pics/$cover_pic.$random_number");
            $update_cover_pic = "update users set cover_pic='cover pics/$cover_pic.$random_number' where user_id='$user_id'";
            $run_update_cover_pic = mysqli_query($con, $update_cover_pic);
            if ($run_update_cover_pic) {
                echo "<script>window.open('profile.php?user_id=$user_id','_self')</script>";
            }
        }
    } 
}
