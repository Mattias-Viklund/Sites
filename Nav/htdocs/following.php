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
    <title>Following</title>
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
                $sql = "SELECT * FROM `following` WHERE user_id='".$_SESSION['id']."'";
                $result = mysqli_query($link, $sql);
                $subs = mysqli_num_rows($result);
                echo "You're following ".$subs." sub(s).<br>";

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if ($subs != 0)
                        {
                            $sql2 = "SELECT * FROM `subs` WHERE sub_id=".$row['sub_id']."";
                            $result2 = mysqli_query($link, $sql2);

                            if (mysqli_num_rows($result2) > 0) {
                                while($row2 = mysqli_fetch_assoc($result2)) {
                                    
                                    echo "<a href=\"sub/".$row2['sub_name']."\">".$row2['sub_name']."</a><br>";

                                }
                            }
                        }
                    }
                } else {
                    if (mysqli_num_rows($result) != 0)
                        echo "It would seem that you kind of suck.<br>Or something went wrong in the SQL query.<br>Either way I blame you.<br>";
            
                }

                echo "<br>";

                $sql = "SELECT * FROM `friends` WHERE user_id='".$_SESSION['id']."'";
                $result = mysqli_query($link, $sql);
                $subs = mysqli_num_rows($result);
                echo "You have ".$subs." friend(s).<br>";

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if ($subs != 0)
                        {
                            $sql2 = "SELECT * FROM `users` WHERE id=".$row['friend_id']."";
                            $result2 = mysqli_query($link, $sql2);

                            if (mysqli_num_rows($result2) > 0) {
                                while($row2 = mysqli_fetch_assoc($result2)) {
                                    
                                    echo "<p>".$row2['username']."</p><br>";

                                }
                            }
                        }
                    }
                } else {
                    if (mysqli_num_rows($result) != 0)
                        echo "It would seem that you kind of suck.<br>Or something went wrong in the SQL query.<br>Either way I blame you.<br>";
            
                }
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