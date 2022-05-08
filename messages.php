<html>
<?php
session_start();
include("includes/topbar.php");
include("functions/timeago.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
if (isset($_GET['user_id'])) {
    global $con;
    $user_id = $_GET['user_id'];
    if ($user_id != "new") {
        $get_user = "Select * from users where user_id='$user_id'";
        $run_get_user = mysqli_query($con, $get_user);
        $row_user = mysqli_fetch_array($run_get_user);
        $username = $row_user['username'];
        $user_id = $row_user['user_id'];
    }
}

$email = $_SESSION['email'];
$get_current_user = "select * from users where email='$email'";
$run_user = mysqli_query($con, $get_current_user);
$row_user = mysqli_fetch_array($run_user);
$current_user_id = $row_user['user_id'];
$current_username = $row_user['username'];
$current_profile_pic = $row_user['profile_pic'];
?>

<head>
    <title>Messenger</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/messages.css">
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/emojionearea.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="style/emojionearea.min.js"></script>
</head>

<body>
    <div class="messenger">
        <div class="chatMenu">
            <div class='chatMenuWrapper'>
                <?php
                echo "
                <form action='' method='post' style='margin-top:8px'>
                    <input placeholder='Search for people!' class='chatMenuInput' name='searchinput' />
                    <button class='btn btn-info' type='submit' name='search_user_btn' id='search'>Search</button>
                </form>";


                if (isset($_POST['search_user_btn'])) {
                    $search_query = htmlentities($_POST['searchinput']);
                    $get_user = "select * from users where (first_name like '%$search_query%' or last_name like '%$search_query%'
    or username like '%$search_query%') and user_id!='$current_user_id'";
                    $run_user = mysqli_query($con, $get_user);
                    while ($row_user = mysqli_fetch_array($run_user)) {
                        $user_id = $row_user['user_id'];
                        $first_name = $row_user['first_name'];
                        $last_name = $row_user['last_name'];
                        $description = $row_user['description'];
                        $username = $row_user['username'];
                        $profile_pic = $row_user['profile_pic'];

                        echo "
                        <div class='chat'>
                        <a href='messages.php?user_id=$user_id' style='text-decoration:none;cursor:pointer;color:black'>
                        <img src='$profile_pic' title='$username' class='chatImg' />
                        <span class='chatName'>$first_name $last_name</span>
                        </a>
                        </div>
                        ";
                    }
                } else {
                    $get_followers = "select * from followers where user_id='$current_user_id'";
                    $run_followers = mysqli_query($con, $get_followers);
                    while ($row_user = mysqli_fetch_array($run_followers)) {
                        $friend_id = $row_user['friend_id'];
                        $get_user = "select * from users where user_id='$friend_id'";
                        $run_user = mysqli_query($con, $get_user);
                        while ($row_user = mysqli_fetch_array($run_user)) {
                            $user_id = $row_user['user_id'];
                            $first_name = $row_user['first_name'];
                            $last_name = $row_user['last_name'];
                            $description = $row_user['description'];
                            $username = $row_user['username'];
                            $profile_pic = $row_user['profile_pic'];
                        }
                        echo "
                    <div class='chat'>
                    <a href='messages.php?user_id=$user_id' style='text-decoration:none;cursor:pointer;color:black'>
                    <img src='$profile_pic' title='$username' class='chatImg' />
                    <span class='chatName'>$first_name $last_name</span>
                    </a>
                    </div>
                ";
                    }
                }

                ?>
            </div>
        </div>

        <div class="chatBox">
            <div class="chatBoxWrapper">

                <div class="chatBoxTop" id="chatTop">

                    <?php
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        if ($user_id != "new") {
                           
                            $get_msgs = "select * from messages where (reciever_id='$user_id' and sender_id='$current_user_id')
                             or (reciever_id='$current_user_id' and sender_id='$user_id') order by 1 ASC";
                            $run_msgs = mysqli_query($con, $get_msgs);
                            while ($row_msg = mysqli_fetch_array($run_msgs)) {
                                $sender_id = $row_msg['sender_id'];
                                $reciever_id = $row_msg['reciever_id'];
                                $date = $row_msg['date'];
                                $text = $row_msg['text'];


                                if (($reciever_id == $user_id) && ($sender_id == $current_user_id)) {
                                    echo "
                                    <div class='message own'>
                                    <div class='messageTop'>
                                        <img src='$current_profile_pic' class='messageImg' />
                                        <p class='messageText'>$text</p>
                                    </div>
                                    <div class='messageBottom'>";
                                    timeago(date($date));
                                    echo "</div>
                                </div>  
                                    ";

                                } 
                                else if (($reciever_id ==$current_user_id) && ($sender_id == $user_id)) {
                                    $get_profile_pic = "Select profile_pic from users where user_id='$sender_id'";
                                    $run_pic = mysqli_query($con,$get_profile_pic);
                                    $row_pic = mysqli_fetch_array($run_pic);
                                    $profile_pic = $row_pic['profile_pic'];

                                    echo "
                                    <div class='message'>
                                    <div class='messageTop'>
                                        <img src='$profile_pic' class='messageImg' />
                                        <p class='messageText'>$text</p>
                                    </div>
                                    <div class='messageBottom'>";
                                    timeago(date($date));
                                    echo "</div>
                                </div>  
                                    ";
                                }

                            }
                           
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        if ($user_id == "new") {
                            echo "<span class='noChatText'>Start Chatting!</span>";
                        } else {
                            echo "";
                        }
                    }
                    ?>

                </div>




                <div class="chatBoxBottom">
                    <?php
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        if ($user_id == "new") {
                            echo "";
                        } else {
                            echo "
                        <form action='' method='post'>
                        <div id='textArea'>
                        <textarea style='display:none;' placeholder='Type something...' class='chatMsgInput' id='msgBox' name='msgBox'></textarea>
                        </div>
                        <div style='display:flex;align-items: center;'>
                     <button type='submit' class='chatSendButton' name='sendMsg'>
                         Send
                     </button>
                    ";

                            if (isset($_POST['sendMsg'])) {

                                $msg = htmlentities($_POST['msgBox']);
                                if ($msg == "") {
                                    echo "<h4>message not sent!</h4>";
                                } else if (strlen($msg) > 255) {
                                    echo "<h4>message is too long to be sent! Use less than 256 characters.</h4>";
                                } else {
                                    $insert_msg = "insert into messages(sender_id,reciever_id,text,date,seen)
                    values('$current_user_id','$user_id','$msg',NOW(),'false')";
                                    $run_insert = mysqli_query($con, $insert_msg);
                                }
                            }
                            echo "</div></form>";
                        }
                    }
                    ?>

                </div>
            </div>

        </div>
        <div class="chatOnline">
            <div class="chatOnlineWrapper">
                <?php
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];
                    if ($user_id != "new") {
                        $get_user = "Select * from users where user_id='$user_id'";
                        $run_get_user = mysqli_query($con, $get_user);
                        $row_user = mysqli_fetch_array($run_get_user);
                        $username = $row_user['username'];
                        $user_id = $row_user['user_id'];
                        $profile_pic = $row_user['profile_pic'];
                        $first_name = $row_user['first_name'];
                        $last_name = $row_user['last_name'];
                        $gender = $row_user['gender'];
                        $country = $row_user['country'];
                        $registeration_date = $row_user['registration_date'];
                        $relationship_status = $row_user['relationship_status'];


                        echo "
                        <div style='text-align:center'>
                        <div style='box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px; padding:20px 50px'>
                        <h4 class='rightbarTitle'>About $first_name $last_name</h4>
                <hr>
                <a href='user_profile.php?user_id= $user_id'><img src='$profile_pic' class='img-circle' width='130px' height='100px' id='info_img'/></a>
                <div class='rightbarInfo'>
                    <div class='rightbarInfoItem'>
                        <span class='rightbarInfoKey' >Gender:</span>
                        <span class='rightbarInfoValue'>$gender</span>
                    </div>
                    <div class='rightbarInfoItem'>
                    <span class='rightbarInfoKey' >Country:</span>
                    <span class='rightbarInfoValue'>$country</span>
                    </div>
                    <div class='rightbarInfoItem'>
                        <span class='rightbarInfoKey' >Birthday:</span>
                        <span class='rightbarInfoValue'>$birthday</span>
                    </div>
                    <div class='rightbarInfoItem'>
                        <span class='rightbarInfoKey' >Relationship Status:</span>
                        <span class='rightbarInfoValue'>$relationship_status</span>
                    </div>
                   
                    <div class='rightbarInfoItem'>
                        <span class='rightbarInfoKey' >Member since:</span>
                        <span class='rightbarInfoValue'>$registeration_date</span>
                    </div>
                    </div>
                    </div> ";
                    }
                    else{
                        echo "";
                    }
                }
                ?>
            </div>
        </div>











</body>

</html>

<script>
    $(document).ready(function() {
        $('#msgBox').emojioneArea({
            pickerPosition: "bottom"
        });

    });
    var div=document.getElementById("chatTop");
    div.scrollTop=div.scrollHeight;

</script>