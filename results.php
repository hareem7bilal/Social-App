<html>
<?php
session_start();
include("includes/topbar.php");
include("functions/results.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>
    <title>Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        h3{
            margin-top: 30px;
            margin-left:17px;
        }
    </style>  
</head>

<body>
    <div class="row">
        <center>
            <h3>Results</h>
        </center>
        <div class="col-sm-12">
            <?php results() ?>
        </div>
    </div>


</body>

</html>