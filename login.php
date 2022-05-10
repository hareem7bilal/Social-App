<?php session_start();?> 
<html>
<head>
    <title>Utopia login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css"/>
    <link rel="stylesheet" href="style/login.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/cute-alert.js"></script>  
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
                        <a class="forgotPwd" href="forgot_pwd.php" data-toggle="tooltip" title="reset password">Forgot Password?</a>
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