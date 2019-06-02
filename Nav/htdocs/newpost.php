<?php
session_start();
 
require_once "utils.php";
check_login();

require_once "config.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());

}

$title = $title_err = "";
$text = $text_err = "";
$sub = $sub_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(empty(trim($_POST["title"]))){
        $title_err = "Please enter title.";

    } else{
        $title = trim($_POST["title"]);

    }
    
    if(empty(trim($_POST["text"]))){
        $text_err = "Trying to upload a post without text are we?";

    } else{
        $text = trim($_POST["text"]);

    }

    if(empty(trim($_POST["sub"]))){
        $sub_err = "Make sure to select a sub.";

    } else{
        $sub = trim($_POST["sub"]);
        if ($sub == "All")
        {
            $sub_err = "Bruh, you can't post to All, choose something else.";
            $sub = "";

        }
    }
    
    // No errors.
    if ($title_err == $text_err && $text_err == $sub_err)
    {
        $sql = "INSERT INTO posts (post_title, post_text, post_username, post_sub) VALUES ('".mysqli_real_escape_string($link, $title)."', '".mysqli_real_escape_string($link, $text)."', '".$_SESSION['username']."', '".$sub."')";
        $result = mysqli_query($link, $sql);

        if ($result)
            header("location: forum.php");
        else
            echo "Something went wrong!";

    }
}

?>

<html lang="en">

<head>
    <title>New Post</title>
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
            <p>New Post</p>
            <form action="./newpost.php" method="post">

                Title
                <?php echo $title_err; ?>
                <br>
                <input type="text" name="title" autocomplete="off"><br>

                Text
                <?php echo $text_err; ?>
                <br>
                <textarea rows="20" name="text" autocomplete="off"></textarea><br>

                Sub:
                <?php echo $sub_err; if (!empty($sub_err)) echo "<br>"; ?>
                <select name="sub">
                    <?php
                        $sql = "SELECT * FROM `subs`";
                        $result = mysqli_query($link, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"".$row["sub_name"]."\">" . $row["sub_name"]. "</option>";
                
                            }
                        }
                    ?>
                </select>
                <br>

                <input type="submit" value="Post">
            </form>
        </div>
    </div>
    </div>
</body>
<footer>
    <script src="scripts/sidebar.js"></script>
    <script src="scripts/forum.js"></script>
</footer>

</html>