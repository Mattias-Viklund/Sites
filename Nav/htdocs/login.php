<?php
session_start();
require_once "config.php";

$err = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty(trim($_POST["username"]))) {
$err = "Please enter username.";
} else {
$username = trim($_POST["username"]);
}

if (empty(trim($_POST["password"]))) {
$err = "Please enter your password.";
} else {
$password = trim($_POST["password"]);
}

if (empty($err)) {
$sql = "SELECT id, username, password, acctype FROM users WHERE username = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
mysqli_stmt_bind_param($stmt, "s", $param_username);

$param_username = $username;

if (mysqli_stmt_execute($stmt)) {
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) == 1) {
mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $acctype);
if (mysqli_stmt_fetch($stmt)) {
if (password_verify($password, $hashed_password)) {
session_start();

$_SESSION["loggedin"] = true;
$_SESSION["id"] = $id;
$_SESSION["username"] = $username;
$_SESSION["acctype"] = $acctype;

header("location: welcome.php");
} else {
$err = "The password you entered was not valid.";
}
}
} else {
$err = "No account found with that username.";
}
} else {
echo "Oops! Something went wrong. Please try again later.";
}
}
mysqli_stmt_close($stmt);
}
mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
<div class="wrapper">
<h2>Login</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div>
<p><?php echo $err; ?></p>
</div>
<div>
<label>Username</label>
<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
</div>
<div>
<label>Password</label>
<input type="password" name="password" class="form-control">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="Login">
</div>
<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</form>
</div>
</body>

</html>
