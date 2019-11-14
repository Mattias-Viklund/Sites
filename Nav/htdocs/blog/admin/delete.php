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
<link rel="stylesheet" type="text/css" href="../blog.css">
</head>
<body>
<div id="navbar">
<a href="../index.php">Home</a>
<a href="../blog/index.php">Blog</a>
<a href="../account.php">Account</a>
<?php
if ($is_admin) {
echo '<a href="../post.php">New Post</a>';
echo '<a href="../admin.php">Admin Control</a>';
}
?>
<?php
if ($is_user) {
echo '<a href="../logout.php" style="float: right;">Sign Out</a>';
} else {
echo '<a href="../login.php" style="float: right;">Sign In</a>';
}
?>
</div>
<div id="catbar">
<a href="../test.php">TEST</a>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST["id"])) {
require_once("../../config.php");
require_once("../articles.php");
delete_article($link, $_POST["id"]);
} else {
header("location: ../index.php");
}
} else {
if (isset($_GET["id"])) {
echo '<script>';
echo 'function goToRoot(){ ';
$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
echo 'window.location.href="' . $root . '"; ';
echo '}</script>';
} else {
header("location: ../index.php");
}
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<label>Are you sure you want to delete this file?</label>
<br>
<label>ID:</label>
<input type="number" name="id" value="<?= $_GET["id"] ?>" readonly />
<br>
<input type="submit" value="Yes" style="display: inline;" />
</form>
<button onclick="goToRoot()">NO</button>
</body>
</html>
