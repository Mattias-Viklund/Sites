<?php
session_start();
require_once "config.php";

$err = $username = $password = $confirm_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty(trim($_POST["username"]))) {
$err = "Please enter a username.";
} else {
$sql = "SELECT id FROM users WHERE username = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
mysqli_stmt_bind_param($stmt, "s", $param_username);

$param_username = trim($_POST["username"]);

if (mysqli_stmt_execute($stmt)) {
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) == 1) {
$err = "This username is already taken.";
} else {
$username = trim($_POST["username"]);
}
} else {
echo "Something went wrong. Please try again later.";
}
}
mysqli_stmt_close($stmt);
}

if (empty(trim($_POST["password"]))) {
$err = "Please enter a password.";
} elseif (strlen(trim($_POST["password"])) < 6) {
$err = "Password must have atleast 6 characters.";
} else {
$password = trim($_POST["password"]);
}

if (empty(trim($_POST["confirm_password"]))) {
$err = "Please confirm password.";
} else {
$confirm_password = trim($_POST["confirm_password"]);
if (empty($password_err) && ($password != $confirm_password)) {
$err = "Password did not match.";
}
}

if (empty($err)) {
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";

if ($stmt = mysqli_prepare($link, $sql)) {
mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

$param_username = $username;
$param_password = password_hash($password, PASSWORD_DEFAULT);

if (mysqli_stmt_execute($stmt)) {
header("location: login.php");
} else {
echo "Something went wrong. Please try again later.";
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
<title>Sign Up</title>
</head>

<body>
<h2>Sign Up</h2>
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
<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
</div>
<div>
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" value="Submit">
<input type="reset" class="btn btn-default" value="Reset">
</div>
<p>Already have an account? <a href="login.php">Login here</a>.</p>
</form>
</body>

</html>
