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
<?php
$resultsperpage = 5;
$page = 0;
$category = -1;
if (isset($_GET['page'])) {
$page = $_GET['page'];
}
if (isset($_GET['category'])) {
$category = $_GET['category'];
}
require_once("../config.php");
require_once('HTML/BBCodeParser2.php');
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
$parser = new HTML_BBCodeParser2($options);
require_once("articles.php");
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="blog2.css">
<title>Test</title>
</head>
<body>
<a href="index.php"><img class="title-img" src="img/title.png" width="512px" /></a>
<nav class="navbar navbar-expand-md m-dark">
<a class="navbar-brand m-shade" href="index.php">EXEDUMP</a>
<button class="navbar-toggler m-light" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" href="../index.php">HOME</a></li>
<li class="nav-item"><a class="nav-link" href="index.php">BLOG</a></li>
<li class="nav-item"><a class="nav-link" href="downloads.php">DOWNLOADS</a></li>
</ul>
</div>
</nav><br>
<div class="container-fluid">
<div class="row">
<div class="col sidebar">
<h3 class="m-shade">Categories</h3>
<hr>
<ul>
<?php
$categories = get_categories($link);
if (is_array($categories) || is_object($categories)) {
foreach ($categories as $cat) {
echo '<li><a href="' . $_SERVER['PHP_SELF'] . '?category=' . $cat['id'] . '">' . $cat['name'] . '</a></li>';
}
}
?>
</ul>
</div>
<div class="col-sm-10 m-content">
<h3 class="m-shade">Recent Posts</h3>
<hr>
<div class="post">
<?php
$articleCount = get_total_articles($link, $category)[0];
$articles = articles_load($link, $resultsperpage, $resultsperpage * $page, $category);
if (is_array($articles) || is_object($articles)) {
foreach ($articles as $article) {
echo '<div class="post">';
echo '<h3>' . $article["title"] . '</h3>';
echo '<h5>' . $article["date"] . (($article["worktime"] > 0) ? ", Worked for " . $article["worktime"] . " hours." : "") . '</h5>';
if (!empty($article["thumbnail"]))
echo '<img src="' . $article["thumbnail"] . '" width="256" alt="Click to open full image."">';
$parser->setText($article['content']);
$parser->parse();
$parsed = $parser->getParsed();
echo '<p>' . nl2br($parsed) . '</p>';
echo '<br>';
if (!empty($article["git_commit"])) {
echo '<a href="' . $article["git_commit"] . '">Github Commit</a>';
echo '<br>';
}
echo '<a href="comment.php?id=' . $article["id"] . '">Comment</a>';
if ($is_admin) {
echo '<br>';
echo '<div class="admin_tools">';
echo '<b>Admin Tools</b>';
echo '<a href="admin/edit.php?id=' . $article["id"] . '">Edit</a>';
echo '<a href="admin/delete.php?id=' . $article["id"] . '">Remove</a>';
echo '</div>';
}
echo '</div>';
echo '<hr>';
}
}
?>
</div>
<div>
<div class="links nopad">
<?php
$pages = ceil($articleCount / $resultsperpage);
for ($i = 0; $i < $pages; $i++) {
echo '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '">' . $i . '</a>';
}
?>
</div>
<div class="links nopad">
<a href="https://github.com/mattias-viklund">Github</a>
<a href="https://github.com/mattias_viklund">Twitter</a>
<a href="https://steamcommunity.com/id/zeseductivebanana">Steam</a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
