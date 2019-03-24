<?php
// Initialize the session
session_start();
 
require_once "utils.php";
check_login();

// Include config file
require_once "config.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
    
}

$sql = "SELECT sub_name FROM subs;";
$result = mysqli_query($link, $sql);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum All</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="forum.css">
    <style type="text/css">
        body{ 
            font: 14px sans-serif; z
            text-align: center; 
            
        }

        .sublist {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333333
  
        }

        .subitem {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 16px;
            text-decoration: none;
            width: 20%;
  
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Showing all subs.</h1>
    </div>

    <div class="page-header">
        <ul class="sublist">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo ("<li class=\"subitem\"><a href=/sub/".$row["sub_name"].">".$row["sub_name"]."</a></li>");

            }
        } else {
            echo "No subs";
    
        }

        mysqli_close($link);
        ?>
        <ul>
    </div>
    <p>
        <a href="forum.php" class="btn btn-primary">Home</a>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
</body>
</html>