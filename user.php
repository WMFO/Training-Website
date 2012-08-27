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
<title="User Management">
</head>
<body>
<h1>The Alimighty User Management Page</h1>
<p>Below is a list of users. Make sure to activate them BEFORE registration. Unactivated Trainees will not be able to login or register, and unactivated Trainers will NOT show up in the registration list. This is important!</p>
<form name="usermanform" method="post" action="">
<table border="2">
<tr>
<th>Delete</th>
<th>Name</th>
<th>Email</th>
<th>Type</th>
<th>Show Name</th>
<th>Show Time/Day</th>
<th>Activate</th>
</tr>

</table>
<input type="submit" value="Set User Activation" name="activate">
</form>
</body>
</html>
