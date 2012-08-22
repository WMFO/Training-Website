<?php
require_once("./includes/session_timeout.inc.php");
if($_SESSION['role'] != 'admin'){
   header('Location: /index.php');
}

?>
<html>
<head>
<link rel="stylesheet" type="test/css" href="./includes/anytime.c.css" />
<script src="./includes/jquery.js"></script>
<script src="/anytime.c.js"></script>
<title="Settings Management">
</head>
<body>
<h1>Settings Page</h1>
Here you can configure settings. Soon.
</body>
</html>
