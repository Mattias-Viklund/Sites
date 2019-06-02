<?php
// Initialize the session
session_start();
 
require_once "../../utils.php";
check_sublogin();

// Include config file
require_once "../../config.php";
require_once "../../server.php"; 

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}   

$currentsub = str_replace("/sub/", "", dirname($_SERVER["PHP_SELF"]));
$sql = "SELECT * FROM posts WHERE post_sub='".$currentsub."';";
$result = mysqli_query($link, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($currentsub); ?></title>
    <link rel="stylesheet" href="../../forum.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div id="sidebar" class="sidebar">
        <img src="../../images/Placeholder.png" style="border-image-repeat: stretch;">
        <a href="../../forum.php">HOME</a>
        <a href="../../subs.php">SUBS</a>
        <a href="../../following.php">FOLLOWING</a>
        <a href="../../profile.php">PROFILE</a>
        <div class="bottomsidebar">
            <a href="../../settings.php">SETTINGS</a>
            <a href="../../logout.php">SIGN OUT</a>
        </div>
    </div>
    <div id="main">
        <button class="openbtn" id="openbtn" onclick="toggleNav()"></button>
        <div id="content">
            <h1><b><?php echo htmlspecialchars($currentsub); ?></b>
                <button id="subscribe" onclick="subscribe();">+Subscribe</button>
            </h1>

            <?php
            load_posts($result, false);
            is_user_following($link, $_SESSION['id'], $currentsub);
            mysqli_close($link);
            ?>

            <div>
                <?php echo "<a href=\"../../newpost.php?sub=".$currentsub."\" class=\"btn btn-info\">Post New Text</a>"; ?>
                <a href="../../logout.php" class="btn btn-danger">Sign Out</a>
            </div>
        </div>
    </div>
</body>

<footer>
    <script src="../../scripts/sidebar.js"></script>
    <script src="../../scripts/forum.js"></script>
    <script src="../../scripts/sub.js"></script>
</footer>

</html>