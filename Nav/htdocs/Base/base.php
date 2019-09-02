<?php require_once 'ti.php' ?>

<html>

<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='content-type' content='text/html; charset=UTF-8'>
<link rel='stylesheet' type='text/css' href='index.css'>
<link href='https://fonts.googleapis.com/css?family=Blinker|Oxygen&display=swap' rel='stylesheet'>

<style>
body {
font-family: 'Oxygen', sans-serif;
text-decoration: none;

}
</style>

</head>

<body>
<a href='index.html' id='logo'></a>

<div id='navbar'>
<?php emptyblock('navbar') ?>
</div>

<div id='main'>
<?php emptyblock('main') ?>
</div>
</body>

<footer>
<p id='footer'>
<?php emptyblock('footer') ?>
</p>
<script src='index.js'></script>

</footer>

</html>
