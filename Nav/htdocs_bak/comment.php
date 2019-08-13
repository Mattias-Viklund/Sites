<?php
// Initialize the session
session_start();

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

<html lang="en">
<head>
  <title>Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="forum.css">
</head>

<body>
  <div id="sidebar" class="sidebar">
    <img src="images/Placeholder.png" style="border-image-repeat: stretch;">
    <a href="forum.php">HOME</a>
    <a href="subs.php">SUBS</a>
    <a href="following.php">FOLLOWING</a>
    <a href="profile.php">PROFILE</a>
    <div class="bottomsidebar">
      <a href="settings.php">SETTINGS</a>
      <a href="logout.php">SIGN OUT</a>
    </div>
  </div>
  <div id="main">
    <button class="openbtn" id="openbtn" onclick="toggleNav()"></button>
    <div id="content">
      <?php 
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    $time = explode(" ", $row["created_at"]);
                    echo "<p><b>".$row["post_title"]."</b></p>";
                    echo "<p>".str_replace(htmlspecialchars("<br>"), "<br>", $row["post_text"])."</p>";
                    echo "<hr>";
                    echo "<p>By <b>".$row["post_username"]."</b> to <b>".$row["post_sub"]."</b> at ".$time[0]." - ".$time[1]."</p>";
    
                }
            }
        } else {
            echo "0 results";
    
        }
    
        mysqli_close($link);
      ?>
    </div>
  </div>
</body>
<footer>
  <script src="scripts/sidebar.js"></script>
  <script src="scripts/forum.js"></script>
</footer>

</html>