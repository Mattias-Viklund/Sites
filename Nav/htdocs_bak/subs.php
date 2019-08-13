<?php
session_start();

// Include config file
require_once "config.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
    
}

$sql = "SELECT sub_name FROM subs;";
$result = mysqli_query($link, $sql);

?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="forum.css">
    <title>Subs</title>
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
            <h1>Showing all subs.</h1>

            <ul class="sublist">
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo ("<li class=\"subitem\"><a href=./sub/".$row["sub_name"].">".$row["sub_name"]."</a></li>");

                    }
                } else {
                echo "No subs";
    
                }

                mysqli_close($link);
                ?>
            </ul>
            <p></p>
            <div>
                <a href="forum.php" class="btn btn-primary">Home</a>
                <a href="createsub.php">Create New Sub</a>
                <a href="logout.php" class="btn btn-danger">Sign Out</a>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="scripts/sidebar.js"></script>
    <script src="scripts/forum.js"></script>
</footer>

</html>