<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;

}

// Include config file
require_once "../../config.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    

}

$currentsub = str_replace("/sub/", "", dirname($_SERVER["PHP_SELF"]));
$sql = "SELECT * FROM posts WHERE post_sub='".$currentsub."';";

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sub <?php echo htmlspecialchars($currentsub); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="index.css">
    <style type="text/css">
        body{ 
            font: 14px sans-serif; text-align: center; 
            
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Current sub: <b><?php echo htmlspecialchars($currentsub); ?></b></h1>
    </div>
    
    <div class="page-header">
    <?php 
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $time = explode(" ", $row["created_at"]);
                echo "<a class=\"post\">" . $time[0]. "(" . $time[1] . ") ". $row["post_username"] . ": ". $row["post_title"]. "<br></a>";
    
            }
        } else {
            echo "0 posts found.";
    
        }
    
        mysqli_close($link);
        ?>
    </div>
    <p>
        <a href="../../post.php" class="btn btn-info">Post New Text</a>
        <a href="../../logout.php" class="btn btn-danger">Sign Out</a>
    </p>
</body>
</html>