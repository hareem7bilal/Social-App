<html>

<head>
    <title>Utopia register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
    <script src="style/cute-alert.js"></script>  
</head>

<body>
    <div class="register">
        <div class="registerWrapper">
            <div class="registerLeft">
                <h3 class="registerLogo">Join Utopia</h3>
                <span class="registerDesc">Reach out to the world with Utopia.</span>
            </div>
            <div class="registerRight">
                <form class="registerBox" method="post" action="">
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="email" placeholder="Email" type="email" class="form-control" id="registerInput" required />
                    </div>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="first_name" placeholder="First Name" type="text" class="form-control" id="registerInput" required />
                    </div>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input name="last_name" placeholder="Last Name" type="text" class="form-control" id="registerInput" required />
                    </div>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input name="password" placeholder="Password" type="password" class="form-control" id="registerInput" minLength="8" required />
                    </div>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        <select class="form-control" name="country" id="registerInput" required>
                            <option disabled>Select Your Country</option>
                            <option>Pakistan</option>
                            <option>USA</option>
                            <option>UK</option>
                            <option>Germany</option>
                            <option>India</option>
                            <option>France</option>
                            <option>Turkey</option>
                            <option>Japan</option>
                        </select>
                    </div>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                        <select class="form-control input-md" name="gender" id="registerInput" required>
                            <option disabled>Select Your Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="input-group" id="inputContainer">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input name="birthday" placeholder="Birthday" type="date" class="form-control input-md" id="registerInput" required />
                    </div>
                    <button class="registerButton" name="signup">Sign Up</button>
                    <a class="registerloginButton" href="login.php">Already have an account?</a>
                    <?php include("insert_user.php"); ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>