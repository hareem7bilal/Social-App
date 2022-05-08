<?php
$con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
include("profile_getPosts.php");
function profile_createPost()
{
    global $con;
    global $user_id;
    $postText = htmlentities($_POST['postText']);
    $postImg = $_FILES['postImg']['name'];
    $img_tmp = $_FILES['postImg']['tmp_name'];
    $random_number = rand(1, 100);

    if (strlen($postText) > 500) {
        echo "<script>
        cuteToast({
            type: 'warning',
            title: 'Warning',
            message: 'Use less than 500 characters.',
          })
          </script>";
    } 
    else {
        if (strlen($postImg) >= 1 && strlen($postText) >= 1) {
            move_uploaded_file($img_tmp, "post imgs/$postImg.$random_number");
            $insert_post = "insert into posts(user_id,content,image,date) values('$user_id','$postText','post imgs/$postImg.$random_number',NOW())";
            $run_insert_post = mysqli_query($con, $insert_post);
            if ($run_insert_post) {
                profile_getPosts();
                $update = "update users set posts='yes' where user_id='$user_id'";
                $run_update = mysqli_query($con, $update);
                echo "<script>
                cuteToast({
                    type: 'success',
                    title: 'Success!',
                    message: 'You just posted.',
                  })
                  </script>";
            }
      
        } else {
            if ($postImg == '' && $postText == '') {
                echo "<script>
                cuteToast({
                    type: 'warning',
                    title: 'Warning',
                    message: 'Empty post.',
                  })
                  </script>";
            } 
            else {
                if ($postText == '') {
                    move_uploaded_file($img_tmp, "post imgs/$postImg.$random_number");
                    $insert_post = "insert into posts(user_id,image,date) values('$user_id','post imgs/$postImg.$random_number',NOW())";
                    $run_insert_post = mysqli_query($con, $insert_post);
                    if ($run_insert_post) {
                        profile_getPosts();
                        $update = "update users set posts='yes' where user_id='$user_id'";
                        $run_update = mysqli_query($con, $update);
                        echo "<script>
                        cuteToast({
                            type: 'success',
                            title: 'Success!',
                            message: 'You just posted.',
                          })
                          </script>";
                    }
                    exit();
                } 
                else {
                    $insert_post = "insert into posts(user_id,content,date) values('$user_id','$postText',NOW())";
                    $run_insert_post = mysqli_query($con, $insert_post);
                    if ($run_insert_post) {
                        profile_getPosts();
                        $update = "update users set posts='yes' where user_id='$user_id'";
                        $run_update = mysqli_query($con, $update);
                        echo "<script>
                        cuteToast({
                            type: 'success',
                            title: 'Success!',
                            message: 'You just posted.',
                          })
                          </script>";
                    }
                    exit();
                }
            }
        }
    }

    
}
?>