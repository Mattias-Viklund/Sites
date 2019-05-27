<?php
// Initialize the session
session_start();
 
//require_once "utils.php";
//check_login();

// Include config file
require_once "config.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM posts;";
$result = mysqli_query($link, $sql);

?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
  <link rel="stylesheet" href="forum.css">
</head>

<body>
  <div id="sidebar" class="sidebar">
    <img src="images/Placeholder.png" style="border-image-repeat: stretch;">
    <a href="#">HOME</a>
    <a href="#">SUBS</a>
    <a href="#">FOLLOWING</a>
    <a href="#">PROFILE</a>
    <div class="bottomsidebar">
      <a href="#">SETTINGS</a>
      <a href="#">SIGN OUT</a>
    </div>
  </div>

  <div id="main">
    <button class="openbtn" id="openbtn" onclick="toggleNav()"></button>
    <div id="header">

    </div>

    <div id="content">
      <?php 
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $time = explode(" ", $row["created_at"]);
                echo "<a href=\"comment.php?post=".$row["post_id"]."\">" . $time[0]. "(" . $time[1] . ") ". $row["post_username"] . ": ". $row["post_title"]. "<br></a>";
    
            }
        } else {
            echo "0 results";
    
        }
    
        mysqli_close($link);
        ?>
      <!-- PHP CODE TO LOAD -->
      <!-- THUMBNAIL, TITLE -->
      <!-- LINK TO COMMENTS, SHARE -->
    </div>
    <div class="links">
      <p>
        <a href="newpost.php" class="btn btn-info">Post New Text</a>
        <a href="createsub.php" class="btn btn-primary">Create New Sub</a>
        <a href="subs.php" class="btn btn-link">Show Subs</a>
      </p>
    </div>
  </div>
</body>
<footer>
  <script src="sidebar.js"></script>
  <script src="forum.js"></script>
</footer>
</html>