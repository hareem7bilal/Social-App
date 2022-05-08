<style>
    <?php include("style/leftbar.css"); ?>
</style>

<?php
include("includes/connection.php");

function get_birthdays()
{

    global $con;
    $email = $_SESSION['email'];
    $get_current_user = "select * from users where email='$email'";
    $run_user = mysqli_query($con, $get_current_user);
    $row_user = mysqli_fetch_array($run_user);
    $current_user_id = $row_user['user_id'];
    
    $check_friends = "select * from users where user_id=(select friend_id from followers where user_id='$current_user_id')";
    $run_friends = mysqli_query($con, $check_friends);
    $is_birthday=0;

    echo "<span class='birthdayText'>";
    if (mysqli_num_rows($run_friends) > 0) {

        while ($row_friend = mysqli_fetch_array($run_friends)) {

            $first_name = $row_friend['first_name'];
            $last_name = $row_friend['last_name'];
            $birthday = $row_friend['birthday'];
            $Birth_day = strtotime($birthday);
            if(date('m-d') == date('m-d', $Birth_day)){
                echo "<b>$first_name $last_name</b>,&nbsp;";
                $is_birthday++;
            } 

        }
        if($is_birthday>0){
            echo $is_birthday > 1 ? "have" : "has";
            echo " a birthday today!";
        }
        else{
            echo "No birthdays today!";
        }
       
    } 
    else {
        echo "No birthdays today!";
    }
    echo "</span>";
}
?>