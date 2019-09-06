<?php
// Initialize the session
session_start();
require_once "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="blog.css">
</head>

<body>
<p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>

<a href="index.php">Index</a>
<a href="admin.php">Admin</a>
<a href="post.php">Post</a>
<a href="reset-password.php">Reset Your Password</a>
<a href="logout.php">Sign Out of Your Account</a>

</body>

</html>
