<?php
session_start();
require_once "session.php";

$admin = false;

if ($_SESSION["acctype"] == 0)
$admin = true;
else {
echo "Pliz don't come in.";
exit(69);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Admin Page</title>
</head>

<body>
<p>Yer an admin Harry.</p>
<a href="post.php">Create New Post</p>
<a href="post.php">Test</p>
</body>

</html>
