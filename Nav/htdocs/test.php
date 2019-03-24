<?php
// Initialize the session
session_start();
 
require_once "utils.php";
check_login();

// Include config file
require_once "config.php";
require_once "server.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
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
            font: 14px sans-serif; text-align: center; 
            
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Showing all posts.</h1>
    </div>

    <div class="page-header">
    <?php 
        $result = get_user_friends($link, "5");
        if (mysqli_stmt_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $time = explode(" ", $row["created_at"]);
                echo ("<p>". $row["sub_id"] . "<br></p>");
    
            }
        } else {
            echo "0 results";
    
        }
        mysqli_stmt_close($result);
        mysqli_close($link);

    ?>
    </div>
    <p>
        <a href="newpost.php" class="btn btn-info">Post New Text</a>
        <a href="createsub.php" class="btn btn-primary">Create New Sub</a>
        <a href="subs.php" class="btn btn-link">Show Subs</a>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
</body>
</html>