<?php
include("includes/connection.php");
if (isset($_POST['login'])) {
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $select_user_query="select * from users where email='$email' AND password='$password' AND status='verified'";
    $run_select_user_query=mysqli_query($con, $select_user_query);
    $check_user=mysqli_num_rows($run_select_user_query);
    if($check_user==1){
        $_SESSION['email']= $email;
        echo "<script>window.open('home.php','_self')</script>";
    }
    else{
        echo "<script>
        cuteAlert({
            type: 'error',
            title: 'Error',
            message: 'Incorrect credentials!',
            buttonText: 'Okay',
            img:'style/img/error.svg'
          })
          </script>";
    }
}
?>