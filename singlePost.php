<html>
<?php
session_start();
include("includes/topbar.php");
include("functions/getPosts.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>
    <title>View Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/emojionearea.min.css">
    <script src="style/emojionearea.min.js"></script>
    <script src="style/cute-alert.js"></script>
    <link rel="stylesheet" href="style/post.css">
</head>

<body>
<div class="row">
    <div class="col-sm-12">
        <?php single_post()?>
    </div>
</div>
</body>

</html>