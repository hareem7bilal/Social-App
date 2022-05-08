<html>
<?php
session_start();
include("includes/topbar.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>
    <title>Utopia Home:&nbsp;<?php echo "$username"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/emojionearea.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/emojionearea.min.js"></script>
    <script src="style/cute-alert.js"></script>
</head>

<body>
    <div class="homeContainer">
        <?php include("includes/leftbar.php"); ?>
        <?php include("includes/feed.php"); ?>
    </div>


</body>

</html>