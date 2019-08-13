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

<html lang="en">
<head>
  <title>Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
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
        echo "You're ".$_SESSION['username']."<br>";

        $sql = "SELECT * FROM `users` WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "You've been registered since: ".$row['created_at'].".<br>";

          }
        } else {
          echo "It would seem that you kind of suck.<br>Or something went wrong in the SQL query.<br>Either way I blame you.<br>";
  
        }

        $sql = "SELECT * FROM `posts` WHERE post_username='".$_SESSION['username']."'";
        $result = mysqli_query($link, $sql);
        $posts = mysqli_num_rows($result);
        echo "You've made ".$posts." post(s).<br>";


        $sql = "SELECT * FROM `following` WHERE user_id='".$_SESSION['id']."'";
        $result = mysqli_query($link, $sql);
        $subs = mysqli_num_rows($result);
        echo "You're following ".$subs." sub(s).<br>";


        $sql = "SELECT * FROM `friends` WHERE user_id='".$_SESSION['id']."'";
        $result = mysqli_query($link, $sql);
        $friends = mysqli_num_rows($result);
        echo "You have ".$friends." friend(s).<br>";


      ?>
    </div>
    </div>
  </div>
</body>
<footer>
  <script src="scripts/sidebar.js"></script>
  <script src="scripts/forum.js"></script>
</footer>

</html>