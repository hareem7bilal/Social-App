<html>
<?php
session_start();
include("includes/connection.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
} else {
    $email = $_SESSION['email'];
    $select_user_query = "select * from users where email='$email'";
    $run_select_user_query = mysqli_query($con, $select_user_query);
    $check_user = mysqli_fetch_array($run_select_user_query);
    $user_id = $check_user['user_id'];
}
?>

<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/cute-alert.js"></script>
    <style>
        .registerBox {
            height: 245px;
        }

        #recovery_question {
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.3);
            margin-bottom: -10px;
        }

        .registerloginButton {
            background-color: rgb(138, 24, 138);
            width: 60%;
        }

        .registerloginButton:hover {
            background-color: rgb(158, 37, 158);
        }
    </style>
</head>

<body>
    <div class="register">
        <div class="registerWrapper">
            <div class="registerLeft">
                <h3 class="registerLogo">Join Utopia</h3>
                <span class="registerDesc">Reach out to the world with Utopia.</span>
            </div>

            <div class="registerRight">
                <center>
                    <h4 style="color:purple;font-weight:bold">Change Your Password</h4>
                </center>

                <form class="registerBox" method="post" action="">

                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input name="password1"  placeholder="Password"  class="form-control" id="registerInput" required />
                    </div>

                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input name="password2"  placeholder="Password Again"  class="form-control" id="registerInput" required />
                    </div>
                    <button type="submit" class="registerloginButton" name="change">Change</button>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['change'])) {

    $password1 = htmlentities(mysqli_real_escape_string($con, $_POST['password1']));
    $password2 = htmlentities(mysqli_real_escape_string($con, $_POST['password2']));


    if ($password1 == $password2) {
        if (strlen($password1) >= 8 && strlen($password1) <= 40) {

            $update_pwd = "update users set password='$password1' where user_id='$user_id'";
            $run_update = mysqli_query($con, $update_pwd);
            echo "<script>window.open('login.php','_self')</script>";
        } 
        else {
            echo "<script>
            cuteAlert({
                type: 'error',
                title: 'Error',
                message: 'Use between 8 & 40 characters.',
                buttonText: 'Okay',
                img:'style/img/error.svg'
              })
              </script>";
        }
    } 
    else {
        echo "<script>
            cuteAlert({
                type: 'error',
                title: 'Error',
                message: 'Passwords dont match.',
                buttonText: 'Okay',
                img:'style/img/error.svg'
              })
              </script>";
    }
}
?>