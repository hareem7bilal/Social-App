<html>
<?php
session_start();
include("includes/topbar.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>
    <title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/edit_profile.css">
    <link rel="stylesheet" href="style/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/cute-alert.js"></script>
</head>

<body>
    <div class="row" id="container">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data" id="edit_profile">
                <table class="table table-borderless" id="form_table">
                    <tr align="center">
                        <td colspan="6" class="active">
                            <h3>Edit Your Profile</h3>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div id="label">First Name</div>
                        </td>
                        <td>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="registerInput" class="form-control" type="text" name="f_name" required value="<?php echo $first_name ?>">
                            </div>

                        </td>
                        <td>
                            <div id="label">Last Name</div>
                        </td>
                        <td>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="registerInput" class="form-control" type="text" name="l_name" required value="<?php echo $last_name ?>">
                            </div>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div id="label">Username</div>
                        </td>
                        <td colspan=3>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="registerInput" class="form-control" type="text" name="username" required value="<?php echo $username ?>">
                            </div>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div id="label">Bio</div>
                        </td>
                        <td colspan=3>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                <input id="registerInput" class="form-control" type="text" name="description" required value="<?php echo $description ?>">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div id="label">Relationship Status</div>
                        </td>
                        <td>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-heart"></i></span>
                                <select class="form-control input-md" name="relationship_status" id="registerInput" required>
                                    <option><?php echo $relationship_status ?></option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>In a relationship</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div id="label">Gender</div>
                        </td>
                        <td>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign"></i></span>
                                <select class="form-control input-md" name="gender" id="registerInput" required>
                                    <option><?php echo $gender ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <div id="label">Password</div>
                        </td>
                        <td colspan=3>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="registerPwd" class="form-control" type="password" name="password" required value="<?php echo $password ?>">
                            </div>
                            <div style="display:flex;align-items:center">
                                <input type="checkbox" onclick="show_password()">&nbsp;
                                <strong style="font-size:11px">Show Password</strong>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div id="label">Country</div>
                        </td>
                        <td>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <select class="form-control input-md" name="country" id="registerInput" required>
                                    <option><?php echo $country ?></option>
                                    <option>USA</option>
                                    <option>UK</option>
                                    <option>Germany</option>
                                    <option>India</option>
                                    <option>France</option>
                                    <option>Turkey</option>
                                    <option>Japan</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div id="label">Birthday</div>
                        </td>
                        <td colspan=3>
                            <div class="input-group" id="inputContainer">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></span>
                                <input id="registerInput" class="form-control" type="date" name="birthday" required value="<?php echo $birthday ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="label">Account Recovery</div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="forgotpwd"><i class="bi bi-shield-check"></i>&nbsp;Turn On</button>
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4>Account Recovery</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="recovery.php?id=<?php echo $user_id ?>" method="post" id="f">
                                                <strong>What's your childhood best friends name?</strong>
                                                <textarea class="form-control" cols="83" rows="4" name="content" placeholder="..."></textarea>
                                                <br>
                                                <input class="btn btn-info" type="submit" id="sub" name="submit" value="Submit" style="width:100px;"><br><br>
                                                <pre>This security question will help you recover your account in case you forget<br>your password.</pre><br><br>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr align="center" style="height:100px;">
                        <td colspan="2">
                            <a href="functions/delete_account.php" id="delete" class="btn btn-info">Delete Account&nbsp;&nbsp;<i class="bi bi-trash" style="font-size:16px"></i></a>
                     
                        </td>
                        <td colspan="2">
                            <button type="submit" class="btn btn-info" name="update_profileinfo" id="submit">Edit&nbsp;&nbsp;<i class="bi bi-pencil-square" style="font-size:16px"></i></button>
                        </td>
                    </tr>

                </table>
            </form>


            <?php
            if (isset($_POST['submit'])) {
                $bfn = htmlentities($_POST['content']);

                if ($bfn == '') {
                    echo "<script>
                    cuteAlert({
                        type: 'warning',
                        title: 'Warning',
                        message: 'Pls enter something!',
                        buttonText: 'Okay',
                        img:'style/img/warning.svg'
                      })
                      </script>";

                    exit();
                } else {
                    $update = "Update users set recovery_account='$bfn' where user_id='$user_id'";
                    $run_update = mysqli_query($con, $update);
                    if ($run_update) {
                        echo "<script>
                        cuteToast({
                            type: 'success',
                            title: 'Success!',
                            message: 'Account recovery is on.',
                          })
                          </script>";
                    } else {
                        echo "<script>
                        cuteAlert({
                            type: 'error',
                            title: 'Error',
                            message: 'Information not updated.',
                            buttonText: 'Okay',
                            img:'style/img/error.svg'
                          })
                          </script>";
                    }
                }
            }

            if (isset($_POST['update_profileinfo'])) {
                $first_name = htmlentities($_POST['f_name']);
                $last_name = htmlentities($_POST['l_name']);
                $password = htmlentities($_POST['password']);
                $country = htmlentities($_POST['country']);
                $gender = htmlentities($_POST['gender']);
                $birthday = htmlentities($_POST['birthday']);
                $relationship_status = htmlentities($_POST['relationship_status']);
                $description = htmlentities($_POST['description']);
                $username = htmlentities($_POST['username']);
                $update = "Update users set first_name='$first_name',last_name='$last_name',password='$password',
                country='$country',gender='$gender',birthday='$birthday',relationship_status='$relationship_status',description='$description',
                username='$username' where user_id='$user_id'";
                $run_update = mysqli_query($con, $update);

                if ($run_update) {
                    echo "<script>
                    cuteToast({
                        type: 'success',
                        title: 'Success!',
                        message: 'Your account has been updated.',
                      })
                      </script>";
                } else {
                    echo "<script>
                    cuteAlert({
                        type: 'error',
                        title: 'Error',
                        message: 'Information not updated.',
                        buttonText: 'Okay',
                        img:'style/img/eeror.svg'
                      })
                      </script>";
                }
            }

            ?>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <script>
        function show_password() {
            var x = document.getElementById("registerPwd");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }


    </script>
</body>


</html>