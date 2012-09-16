<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 3.0 License

Name       : Resolved
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120205
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>Training Portal</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="http://fonts.googleapis.com/css?family=Arvo" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">wmfo tems</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li class="first current_page_item"><a href="index.php">home</a></li>
<?php if(@$_SESSION['role'] == "admin"){?>
        <li><a href="user.php">Manage Users</a></li>
        <li><a href="checklist.php">Checklist</a></li>
        <li><a href="settings.php">Settings</a></li>
<?php } else { ?>        <li><a href="moduser.php">Edit Info</a></li>
				<li><a href="passwdreset.php">Password Reset</a></li>
<?php } ?>
				<li><a href="about.php">About</a></li>
				<li class="last"><a href="?logout=yes">logout</a></li>
			</ul>
			<br class="clearfix" />
		</div>
	</div>
	<div id="page">
		<div id="content">
			<div id="post1">
