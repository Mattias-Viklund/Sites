<html>
<?php
// Initialize the session
session_start();
$is_user = $is_admin = false;
if (isset($_SESSION["acctype"])) {
$is_user = true;
$is_admin = (($_SESSION["acctype"] == 0) ? true : false);
}
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../blog2.css">
<title>Edit</title>
</head>
<body>
<a href="../index.php"><img class="title-img" src="../../img/title.png" width="512px" /></a>
<nav class="navbar navbar-expand-md m-dark">
<a class="navbar-brand m-shade" href="../index.php">EXEDUMP</a>
<button class="navbar-toggler m-light" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" href="../../index.php">HOME</a></li>
<li class="nav-item"><a class="nav-link" href="../index.php">BLOG</a></li>
<li class="nav-item"><a class="nav-link" href="../downloads.php">DOWNLOADS</a></li>
</ul>
</div>
</nav><br>
<div class="container-fluid">
<div class="row">
<div class="col sidebar">
<h3 class="m-shade">Edit Post</h3>
<p>Edit the post, make it meaningful.</p>
</div>
<div class="col-sm-10 m-content">
<?php
$title = $thumbnail = $category = $text = $worktime = $git_commit = "";
$id = -1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once("../../config.php");
include_once("../articles.php");
update_article($link, $_POST["id"], $_POST["title"], $_POST["thumbnail"], $_POST["category"], $_POST["text"], $_POST["git_commit"], $_POST['updateTime'], $_POST["worktime"]);
}
if (isset($_GET["id"])) {
require_once("../../config.php");
include_once("../articles.php");
$id = $_GET["id"];
$articles = get_article($link, $_GET["id"]);
if (is_array($articles) || is_object($articles)) {
foreach ($articles as $article) {
$title = $article["title"];
$thumbnail = $article["thumbnail"];
$category = $article["category"];
$text = $article["content"];
$worktime = $article["worktime"];
$git_commit = $article["git_commit"];
}
}
} else {
header("location: ../index.php");
}
?>
<div class="container">
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<p>Create new Post.</p>
<div>
<label>ID:</label>
<input type="number" name="id" value="<?= $_GET["id"] ?>" readonly />
</div>
<div>
<label>Title</label><br />
<input type="text" name="title" class="form-group" id="half" value="<?= $title; ?>">
</div>
<div>
<label>Thumbnail URL</label><br />
<input type="text" name="thumbnail" class="form-group" id="half" value="<?= $thumbnail; ?>">
</div>
<div>
<label>Category</label>
<select name="category" id="selcat">
<option value="">Custom Category</option>
<?php
$categories = get_categories($link);
$out = "";
if (is_array($categories) || is_object($categories)) {
foreach ($categories as $cat) {
if ($cat['id'] == $category) {
$out = "<script>$('#selcat').val('" . $cat['id'] . "')</script>";
}
echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
}
}
?>
</select>
<?php echo $out; ?>
<label>OR</label>
<input type="text" name="customCategory" class="form-group" id="half" value="" />
</div>
<div>
<label>Text</label><br />
<textarea name="text" rows="28" cols="100" class="form-group" id="half"><?= $text; ?></textarea>
</div>
<div>
<label>Work Time</label><br />
<input type="number" name="worktime" min="0" max="12" style="color:#000; width:25%;" class="form-group" value="<?= $worktime; ?>">
</div>
<div>
<label>Github Commit Link</label><br />
<input type="text" name="git_commit" class="form-group" id="half" value="<?= $git_commit; ?>">
</div>
<div class="form-group">
<label>Update Timestamp?</label>
<input type="checkbox" name="updateTime"><br>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
