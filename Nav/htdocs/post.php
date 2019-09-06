<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Admin Page</title>
</head>

<body>
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

$title = $thumbnail = $text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["title"]) || empty($_POST["thumbnail"]) || empty($_POST["text"])) {
echo "Please enter good data, dude.";
exit(420);
} else {
$title = $_POST["title"];
$thumbnail = $_POST["thumbnail"];
$text = $_POST["text"];
echo "solid data?";
}

$sql = "INSERT INTO `posts` (title, thumbnail, content) VALUES (?, ?, ?)";

$stmt = mysqli_prepare($link, $sql);
echo ($stmt) ? "yes" : "no";

if ($stmt) {

mysqli_stmt_bind_param($stmt, "sss", $param_title, $param_thumbnail, $param_text);

$param_title = $title;
$param_thumbnail = $thumbnail;
$param_text = $text;

if (mysqli_stmt_execute($stmt)) {
header("location: welcome.php");
} else {
echo "Something went wrong. Please try again later.";
}
mysqli_stmt_close($stmt);
}
mysqli_close($link);
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<p>Create new Post.</p>
<div>
<label>Title</label><br/>
<input type="text" name="title" class="form-group" value="<?php echo $title; ?>">

</div>
<div>
<label>Thumbnail URL</label><br/>
<input type="text" name="thumbnail" class="form-group" value="<?php echo $thumbnail; ?>">

</div>
<div>
<label>Text</label><br/>
<textarea name="text" rows="30" cols="100" class="form-group" value="<?php echo $text; ?>">
</textarea>
</div>
<div class="form-group">
<input type="submit" value="Submit">
<input type="reset" value="Reset">

</div>
</form>
</body>

</html>
