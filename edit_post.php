<html>
<?php
session_start();
include("includes/topbar.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/edit_post.css">
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/emojionearea.min.css">
    <script src="style/cute-alert.js"></script>
    <script src="style/emojionearea.min.js"></script>
</head>

<body>

    <?php
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $get_post = "select * from posts where post_id='$post_id'";
        $run_get = mysqli_query($con, $get_post);
        $row = mysqli_fetch_array($run_get);
        $content = $row['content'];
        $image = $row['image'];
    }
    ?>
    <div class="container">
        <div class="card">
            <div class="card-image" style="background-image: url('<?php echo $image ?>');">
            </div>
            <form class="card-form" action="" method="post">
                <div class="form__group">
               <br><textarea id="message" class="form__field" rows="25" name="content"><?php echo $content; ?></textarea>
                    <label for="message" class="form__label">Description</label>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#message').emojioneArea({
                            pickerPosition: "bottom"
                        });

                    });
                </script>
                <div class="action">
                    <button class="action-button" name="update">Edit</button>
                </div>
                <?php
                if (isset($_POST['update'])) {
                    $content = $_POST['content'];
                    $update_post = "update posts set content='$content' where post_id='$post_id'";
                    $run_update = mysqli_query($con, $update_post);
                    if ($run_update) {
                        echo "<script>
                        cuteToast({
                            type: 'success',
                            title: 'Success!',
                            message: 'Your post has been updated.',
                          });
                     
                        </script>";
                      
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>