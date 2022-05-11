<?php
$con = mysqli_connect("localhost:3307", "root", "", "php_socialapp");
session_start();

$msg = $_POST['msg'];
$sender_id = $_POST['sender_id'];
$reciever_id = $_POST['reciever_id'];

$insert_msg = "insert into messages(sender_id,reciever_id,text,date,seen)
        values('$sender_id','$reciever_id','$msg',NOW(),'false')";
$run_insert = mysqli_query($con, $insert_msg);








?>