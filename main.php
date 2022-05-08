<!DOCTYPE html>
<html lang="en">

<head>
    <title>Utopia main</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/main.css">

</head>

<body>
    <div class="bg-image">

        <div class="cloud large cloud-1">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud normal cloud-2">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud small cloud-3">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud tiny cloud-4">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud large cloud-5">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud normal cloud-6">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud small cloud-7">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud tiny cloud-8">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud small cloud-9">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud normal cloud-10">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud tiny cloud-11">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud normal cloud-12">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud normal cloud-13">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud small cloud-14">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cloud small cloud-15">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="bg-text">
        <h1>Utopia</h1>
        <p>Reach out to the world with Utopia.</p><br>
        <form method="post" action="">
            <button id="signup" class="btn btn-info btn-lg" name="signup">Sign Up</button>
            <?php
            if (isset($_POST['signup'])) {
                echo "<script>window.open('register.php','_self')</script>";
            }
            ?>
            <button id="login" class="btn btn-info btn-lg" name="login">Log In</button>
            <?php
            if (isset($_POST['login'])) {
                echo "<script>window.open('login.php','_self')</script>";
            }
            ?>
        </form>
    </div>


</body>

</html>