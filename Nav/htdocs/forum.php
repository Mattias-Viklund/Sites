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

<html>

<head>
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
        <div id="header">

        </div>

        <div id="content">
            <?php
              // NEVER TOUCH THE SACRED CODE
              $sql = "SELECT * FROM `following` WHERE user_id=".$_SESSION['id'].";";
              $result = mysqli_query($link, $sql);

              // NEVER TOUCH THE SACRED CODE
              if (mysqli_num_rows($result) > 0) {
                while($subs = mysqli_fetch_assoc($result)) {
                  $subsql = "SELECT * FROM `subs` WHERE sub_id=".$subs['sub_id'];
                  $subsresult = mysqli_query($link, $subsql);

                  // NEVER TOUCH THE SACRED CODE
                  if (mysqli_num_rows($subsresult) == 1)
                  {
                    $row = mysqli_fetch_assoc($subsresult);
                    $subname = $row['sub_name'];

                    $subsql = "SELECT * FROM `posts` WHERE post_sub='".$subname."'";
                    $postsresults = mysqli_query($link, $subsql);

                    // NEVER TOUCH THE SACRED CODE                    
                    if (mysqli_num_rows($postsresults) > 0)
                    {
                      while($row = mysqli_fetch_assoc($postsresults)) {
                        $time = explode(" ", $row["created_at"]);
                        echo "<a href=\"comment.php?post=".$row["post_id"]."\">" . $row["post_username"] . ": '". $row["post_title"]. "' in ".$subname."<br></a>";
  
                      }
                    }
                  }
                }
              } else {
                echo "You're not following any subs, go to ";
                echo "<a href=\"subs.php\">Subs</a>";
                echo " and find something you like.";
        
              }
              mysqli_close($link);
              ?>
        </div>
        <div class="links">
            <p></p>
            <a href="newpost.php" class="btn btn-info">Post New Text</a>
            <a href="subs.php" class="btn btn-link">Show Subs</a>
        </div>
    </div>
</body>
<footer>
    <script src="scripts/sidebar.js"></script>
    <script src="scripts/forum.js"></script>
</footer>

</html>