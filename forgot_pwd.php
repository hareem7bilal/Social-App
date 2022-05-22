<html>

<head>
    <title>Forgot Password</title>
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
            height: 335px;
        }

        #recovery_question {
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.3);
            margin-bottom: -10px;
        }

        .registerloginButton {
            background-color: rgb(138, 24, 138);
            width: 100%;
        }

        .registerloginButton:hover {
            background-color: rgb(158, 37, 158);
        }

        .registerButton {
            background-color: #38ad21;
            width: 60%;
            align-self: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }

        .registerButton:hover {
            background-color: #42b72a;
            text-decoration: none;
            color: white;
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
                    <h4 style="color:purple;font-weight:bold">Forgot Password?</h4>
                </center>

                <form class="registerBox" method="post" action="">

                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="email" placeholder="Email" type="email" class="form-control" id="registerInput" required />
                    </div>

                    <h5 id="recovery_question">What's your childhood best friends name?</h5>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="recovery_account" placeholder="..." type="text" class="form-control" id="registerInput" required />
                    </div>

                    <button class="registerloginButton" name="recovery_submit" type="submit">Verify</button>
                    <a class="registerButton" name="signup" href="register.php">Sign Up</a>
             

                
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include("includes/connection.php");
if (isset($_POST['recovery_submit'])) {

    $recovery_account = htmlentities(mysqli_real_escape_string($con, $_POST['recovery_account']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));

    $select_user_query = "select * from users where email='$email' AND recovery_account='$recovery_account'";
    $run_select_user_query = mysqli_query($con, $select_user_query);
    $check_user = mysqli_num_rows($run_select_user_query);
    if ($check_user == 1) {
        $_SESSION['email'] = $email;
        echo "<script>window.open('change_pwd.php','_self')</script>";
    } else {
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