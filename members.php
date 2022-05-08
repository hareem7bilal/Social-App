<style>
    #search-input{
        width:30%;
        height:36px;
        border:none;
        border-bottom:1px solid lightgrey;
        padding:5px;
        margin-right: -20px;
    }
    #search-input:focus{
        outline:none;
    }
    #search{
       position: absolute;
       padding:7.2px;
    }
    #search:focus{
        outline:none;
    }

</style>


<html>
<?php
session_start();
include("includes/topbar.php");
include("functions/search_user.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>
    <title>Find People</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="row">
    <div class="col-sm-12">
    <br><br>
       <div class="row">
           <div class="col-sm-4"></div>
           <div class="col-sm-8">
               <form class="search_form" action="">
                   <input type="text" placeholder="Search for people!" name="search_user" id="search-input" >
                   <button class="btn btn-info" type="submit" name="search_user_btn" id="search">Search</button>
               </form>
           </div>
         
       </div><hr style="width:29%;position:relative;left:31%"><br>
       <?php search_user();?>
    </div>
    </div>


</body>

</html>