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

$comment_id = "";

if($_GET["post"]){
    $comment_id = trim($_GET["post"]);

} else {
    die("No comment id was specified.");

}

$sql = "SELECT * FROM posts WHERE post_id = ".$comment_id;
$result = mysqli_query($link, $sql);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="forum.css">
    <style type="text/css">
        body{ 
            font: 14px sans-serif; text-align: center; 
            
        }
    </style>
</head>
<body>
    <?php 
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $time = explode(" ", $row["created_at"]);
                echo "<p style=\"text-align:left; margin: 0px; margin-top:100px; margin-left:100px; font-size: 2em; padding: 0px;\"><b>".$row["post_title"]."</b></h3>";
                echo "<p style=\"text-align:left; margin: 0px; padding: 0px; margin-top: 5px; margin-left:100px;\">By <b>".$row["post_username"]."</b> to <b>".$row["post_sub"]."</b> at ".$time[0]." - ".$time[1]."</p>";
                echo "<p style=\"text-align:left; margin: 0px; padding: 0px; margin-top: 20px; margin-left:100px; font-size: 2em;\">".$row["post_text"]."</p>";
    
            }
        }
     } else {
            echo "0 results";
    
        }
    
        mysqli_close($link);
        ?>
    <p>
        <a href="forum.php" class="btn btn-info">Back</a>
    </p>
</body>
</html>