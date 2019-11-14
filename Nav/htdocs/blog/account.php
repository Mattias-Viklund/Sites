<?php
// Initialize the session
session_start();
$is_user = $is_admin = false;
if (isset($_SESSION["acctype"])) {
$is_user = true;
$is_admin = (($_SESSION["acctype"] == 0) ? true : false);
}
?>
<?php
require_once("session.php");
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
<title>Account</title>
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
<p>Nothing Here</p>
</body>
</html>
