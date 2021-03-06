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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    

}

$sql = "SELECT username FROM users;";
$result = mysqli_query($link, $sql);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum All</title>
    <link rel="stylesheet" href="forum.css">
</head>
<body>
    <div class="page-header">
        <h1>Showing all users.</h1>
    </div>

    <div class="page-header">
        <ul class="sublist">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo ("<li class=\"subitem\">".$row["username"]."</a></li>");

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