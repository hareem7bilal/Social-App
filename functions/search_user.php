<style>
  #find_people{
    box-shadow: 0px 0px 16px -8px rgba(0, 0, 0, 0.68);
    padding:15px;
}
</style>

<?php
include("includes/connection.php");
$email=$_SESSION['email'];
function search_user()
{
    global $con,$email;
    $get_current_user="select * from users where email='$email'";
    $run_user = mysqli_query($con, $get_current_user);
    $row_user = mysqli_fetch_array($run_user);
    $current_user_id = $row_user['user_id'];

    if (isset($_GET['search_user_btn'])) {
        $search_query=htmlentities($_GET['search_user']);
        $get_user="select * from users where (first_name like '%$search_query%' or last_name like '%$search_query%'
        or username like '%$search_query%') and user_id!='$current_user_id'"; 
    } 
    else{
        $get_user="select * from users where user_id!='$current_user_id'";
    }
    $run_user= mysqli_query($con, $get_user);
    while($row_user = mysqli_fetch_array($run_user)){
        $user_id = $row_user['user_id'];
        $first_name= $row_user['first_name'];
        $last_name = $row_user['last_name'];
        $description = $row_user['description'];
        $username = $row_user['username'];
        $profile_pic = $row_user['profile_pic'];

        echo "  <div class='row'>
        <div class='col-sm-4'></div>
        <div class='col-sm-3'>
        <div class='row' id='find_people'>
        <div class='col-sm-5'>
        <a href='user_profile.php?user_id= $user_id'><img src='$profile_pic' width='100px' height='100px' title='$username'
        class='img-circle' /></a>
        </div><br>
        <div class='col-sm--5'>
        <a href='user_profile.php?user_id= $user_id' style='text-decoration:none;cursor:pointer;color:black;'>
        <strong><h4>$first_name $last_name</h4></strong>
        </a>
        <h6 style='color:grey;'>$description</h6>
        </div>
        <div class='col-sm-3'>
   
        </div>
        </div>
   
        </div>
        <div class='col-sm-4'>
   
        </div>
        </div><br>";
    }


}
