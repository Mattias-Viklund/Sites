<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";
require_once "server.php";
 
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
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="forum.css">
</head>

<body>
    <div id="sidebar" class="sidebar">
        <img src="images/Placeholder.png" style="border-image-repeat: stretch;">
        <?php 
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
                echo "<a href=\"index.php\">HOME</a>";
            else
                echo "<a href=\"forum.php\">HOME</a>";

        ?>
        <a href="subs.php">SUBS</a>
        <a href="following.php">FOLLOWING</a>
        <a href="profile.php">PROFILE</a>
        <div class="bottomsidebar">
            <a href="settings.php">SETTINGS</a>
            <?php 
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
                echo "<a href=\"login.php\">LOG IN</a>";
            else
                echo "<a href=\"logout.php\">SIGN OUT</a>";

            ?>
        </div>
    </div>

    <div id="main">
        <button class="openbtn" id="openbtn" onclick="toggleNav()"></button>
        <div id="content">
            <?php
            load_posts($result, true);
            mysqli_close($link);
            ?>
            <!-- PHP CODE TO LOAD -->
            <!-- THUMBNAIL, TITLE -->
            <!-- LINK TO COMMENTS, SHARE -->
        </div>
        <div class="links">
            <p></p>
            <a href="newpost.php">Post New Text</a>
            <a href="subs.php">Show Subs</a>
        </div>
    </div>
</body>
<footer>
    <script src="scripts/sidebar.js"></script>
    <script src="scripts/forum.js"></script>
</footer>

</html>