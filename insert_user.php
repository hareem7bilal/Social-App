<?php
include("includes/connection.php");
if (isset($_POST['signup'])) {
    $first_name = htmlentities(mysqli_real_escape_string($con, $_POST['first_name']));
    $last_name = htmlentities(mysqli_real_escape_string($con, $_POST['last_name']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $country = htmlentities(mysqli_real_escape_string($con, $_POST['country']));
    $gender = htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
    $birthday = htmlentities(mysqli_real_escape_string($con, $_POST['birthday']));
    $status = "verified";
    $posts = "none";
    $newgid = sprintf('%05d', rand(0, 999999));
    $username = strtolower($first_name . "_" . $last_name . "_" . $newgid);
    $check_username_query = "select username from users where email= '$email'";
    $run_username_query = mysqli_query($con, $check_username_query);
    $check_email_query = "Select * from users where email= '$email'";
    $run_email_query = mysqli_query($con, $check_email_query);
    $check_email = mysqli_num_rows($run_email_query);

    if ($check_email > 0) {
        echo "<script>
        cuteAlert({
            type: 'error',
            title: 'Email already exists',
            message: 'Pls use another!',
            buttonText: 'Okay',
            img:'style/img/error.svg'
          })
          </script>";
        exit();
    } else {
        $cover_pic = "cover pics/utopia.png";
        $rand = mt_rand(1,4);

        if ($rand == 1) {
            $profile_pic = "users/p1.jpg";
            $desc = "A sparkly cloud";
        }
        else if ($rand == 2) {
            $profile_pic = "users/p2.jpg";
            $desc = "A gentle avacado";
        }
        else if ($rand == 3) {
            $profile_pic = "users/p3.jpg";
            $desc = "Pick me up!";
        } else {
            $profile_pic = "users/p4.jpg";
            $desc = "A witty ghost";
        }
        $insert_user_query = "insert into users(first_name, last_name,username,description,relationship_status,password,email,
    country,gender,birthday,profile_pic,cover_pic,registration_date,status,posts,recovery_account)
    values('$first_name','$last_name','$username','$desc','...','$password','$email','$country','$gender','$birthday',
    '$profile_pic','$cover_pic',NOW(),'$status','$posts','imaginaryfriend')";
        $run_insert_user_query = mysqli_query($con, $insert_user_query);
        if ($run_insert_user_query) {
            echo "<script>
        cuteAlert({
            type: 'success',
            title: '$first_name $last_name,',
            message: 'Welcome to Utopia!',
            buttonText: 'Okay',
            img:'style/img/success.svg'
          })
          </script>";
        } else {
            echo "<script>
        cuteAlert({
            type: 'error',
            title: 'Registration unsuccessful',
            message: 'Pls try again!',
            buttonText: 'Okay',
            img:'style/img/error.svg'
          })
          </script>";
        }
    }
}
