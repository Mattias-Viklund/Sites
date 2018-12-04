<!DOCTYPE html>
<html Lang="en">

<head>
	<title>ET 340 Schematics</title>
	<link rel="stylesheet" href="../../index.css">
	<link rel="shortcut icon" href="../images/favicon.ico"/>
</head>

<body>
	<nav>
		<ul>
			<li><a href="../../index.html">HOME</a>
			<li><a style="background-color: #444444">SCHEMATICS</a></li>
			<li><a href="../modifications/modifications.html">MODIFICATIONS</a></li>
			<li><a href="../about.html">ABOUT</a></li>
			
		</ul>
	</nav>

	<div class="fileselect">
			<h1>Yote</h1>
			<ul>
			<?php
				$dir    = '/files';
				$files1 = scandir($dir);

				print_r($files1);
			?>
			</ul>


	</div>

	<div class="bottombar">
		<p>Made by Mattias (Mew_) Viklund</p>
		<p>Sweden</p>
	</div>
</body>