<style>
    <?php include("../style/messages.css"); ?>
</style>

<?php
include("timeago.php");
$con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
session_start();

$current_user_id = $_POST['current_user_id'];
$user_id = $_POST['user_id'];

$get_msgs = "select * from messages where (reciever_id='$user_id' and sender_id='$current_user_id')
                             or (reciever_id='$current_user_id' and sender_id='$user_id') order by 1 ASC";
$run_msgs = mysqli_query($con, $get_msgs);
?>


<?php
while ($row_msg = mysqli_fetch_array($run_msgs)) {
    $sender_id = $row_msg['sender_id'];
    $reciever_id = $row_msg['reciever_id'];
    $date = $row_msg['date'];
    $text = $row_msg['text'];


    if (($reciever_id == $user_id) && ($sender_id == $current_user_id)) {
        $get_profile_pic = "Select profile_pic from users where user_id='$sender_id'";
        $run_pic = mysqli_query($con, $get_profile_pic);
        $row_pic = mysqli_fetch_array($run_pic);
        $profile_pic = $row_pic['profile_pic'];?>
        
        <div class='message own'>
        <div class='messageTop'>
            <img src='<?php echo $profile_pic?>' class='messageImg' />
            <p class='messageText'><?php echo $text?></p>
        </div>
        <div class='messageBottom'>
        <?php echo timeago(date($date))?>
        </div>
    </div>  
<?php
    } 
    else if (($reciever_id == $current_user_id) && ($sender_id == $user_id)) {
        $get_profile_pic = "Select profile_pic from users where user_id='$sender_id'";
        $run_pic = mysqli_query($con, $get_profile_pic);
        $row_pic = mysqli_fetch_array($run_pic);
        $profile_pic = $row_pic['profile_pic'];?>

        <div class='message'>
        <div class='messageTop'>
            <img src='<?php echo $profile_pic?>' class='messageImg' />
            <p class='messageText'><?php echo $text?></p>
        </div>
        <div class='messageBottom'>
        <?php echo timeago(date($date))?>
</div>
    </div>  
<?php
    }
}
?>

