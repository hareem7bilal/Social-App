<?php session_start();?> 
<html>
<head>
    <title>Utopia login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/cute-alert.js"></script>  

    <style>
        .login {
            width: 100vw;
            height: 100vh;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .loginWrapper {
            width: 70%;
            height: 70%;
            display: flex;
        }

        .loginLeft,
        .loginRight {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .loginLogo {
            font-size: 50px;
            font-weight: 800;
            color: purple;
            margin-bottom: 10px;
        }

        .loginDesc {
            font-size: 20px;
        }

        .loginBox {
            height: 330px;
            padding: 20px;
            background-color: white;
            background-image: url("/images/utopia.png");
            background-position: center;
            /* Center the image */
            background-repeat: no-repeat;
            /* Do not repeat the image */
            background-size: cover;
            /* Resize the background image to cover the entire container */
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #loginInput {
            border-radius: 10px;
            height: 50px;
            border: 1px solid grey;
            font-size: 18px;
            padding-left: 20px;
        }

        #loginInput:focus {
            outline: none;
        }

        .forgotPwd {
            text-align: center;
            color: rgb(158, 37, 158);
            text-decoration: none;
            font-size: 14px;
            float: right;
            position: absolute;
            top: 13.5px;
            right: 10px;
        }

        .forgotPwd:hover {
            color: rgb(185, 44, 185);
            text-decoration: none;

        }

        .overlap-text {
            position: relative;
        }

        .loginButton,
        .loginregisterButton {
            height: 50px;
            border-radius: 10px;
            border: none;
            color: white;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
        }

        .loginButton {
            background-color: rgb(138, 24, 138);
        }

        .loginButton:hover {
            background-color: rgb(158, 37, 158);
        }

        .loginButton:disabled {
            cursor: not-allowed;
        }

        .loginregisterButton {
            background-color: #38ad21;
            width: 60%;
            align-self: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }

        .loginregisterButton:hover {
            background-color: #42b72a;
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="loginWrapper">
            <div class="loginLeft">
                <h3 class="loginLogo">Utopia</h3>
                <span class="loginDesc">Reach out to the world with Utopia.</span>
            </div>
            <div class="loginRight">
                <form class="loginBox" method="post" action="">
                    <input placeholder="Email" name="email" type="email" class="form-control input-md" id="loginInput" required />

                    <div class="overlap-text">
                        <input placeholder="Password" name="password" type="password" class="form-control input-md" id="loginInput" minLength="8" required />
                        <a class="forgotPwd" href="forgot_password.php" data-toggle="tooltip" title="reset password">Forgot Password?</a>
                    </div>

                    <button class="loginButton" type="submit" name="login">Log in</button>
                    <a class="loginregisterButton" href="register.php">Create a New Account</a>
                </form>
                <?php include("sign_user_in.php"); ?>
            </div>
        </div>
    </div>
</body>

</html>