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
require_once("session.php");
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="blog/blog2.css">
<title>Account</title>
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
<li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
<li class="nav-item"><a class="nav-link" href="blog/index.php">BLOG</a></li>
<li class="nav-item"><a class="nav-link" href="blog/downloads.php">DOWNLOADS</a></li>
</ul>
</div>
</nav><br>
<p>Nothing Here</p>
<div class="container-fluid">
<div class="row">
<div class="col sidebar">
<p>Nothing Here</p>
</div>
<div class="col-sm-10 m-content">
<p>Nothing Here</p>
</div>
</div>
</div>
</body>
</html>
