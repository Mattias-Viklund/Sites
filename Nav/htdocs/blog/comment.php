<?php
// Initialize the session
session_start();
$is_user = $is_admin = false;
if (isset($_SESSION["acctype"])) {
$is_user = true;
$is_admin = (($_SESSION["acctype"] == 0) ? true : false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="blog.css">
</head>
<body>
<div id="navbar">
<a href="index.php">Home</a>
<a href="account.php">Account</a>
<?php
if ($is_admin) {
echo '<a href="post.php">New Post</a>';
echo '<a href="admin.php">Admin Control</a>';
}
?>
<?php
if ($is_user) {
echo '<a href="logout.php" style="float: right;">Sign Out</a>';
} else {
echo '<a href="login.php" style="float: right;">Sign In</a>';
}
?>
</div>
<?php
require_once("config.php");
require_once('HTML/BBCodeParser2.php');
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
$parser = new HTML_BBCodeParser2($options);
$title = $thumbnail = $text = "";
$id = -1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once("config.php");
include_once("articles.php");
}
if (isset($_GET["id"])) {
require_once("config.php");
include_once("articles.php");
$id = $_GET["id"];
$articles = get_article($link, $_GET["id"]);
if (is_array($articles) || is_object($articles)) {
foreach ($articles as $article) {
$title = $article["title"];
$thumbnail = $article["thumbnail"];
$text = $article["content"];
}
}
} else {
header("location: index.php");
}
?>
<div class="container">
<h5><?= $title ?></h5>
<img src="<?= $thumbnail ?>">"
<p>
<?php
$parser->setText($text);
$parser->parse();
$parsed = $parser->getParsed();
echo $parsed;
?>
</p>
<br>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div>
<label>Comment</label><br />
<input name="text" class="form-group" id="comment"></textarea>
</div>
<div class="form-group">
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</div>
</form>
</div>
</body>
</html>
