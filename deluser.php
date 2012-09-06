<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$connw = dbConnect('write');
if(isset($_POST['confirm'])){
  $sql = "DELETE FROM users WHERE user_id = " . $_GET['user'];
  $connw->query($sql);
  header('Location: user.php');
}
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}

?>
<html>
<head>
<link rel="stylesheet" type="test/css" href="./includes/anytime.c.css" />
<script src="./includes/jquery.js"></script>
<script src="/anytime.c.js"></script>
<title="Delete User???">
</head>
<body>
<h1>Really Delete User Below?</h1>
<p>This change is permanent and unrecoverable. If you screw this up, Nick is not going to help you fix it.</p>
<?php
$sql = "SELECT * FROM users WHERE user_id = " . $_GET['user'];
$user = $connw->query($sql);
?>
<form method="post" action="" name="confirmuserdel">
<table border="2">
<tr>
<th>Name</th>
</tr>
<?php
$row = $user->fetch_assoc(); ?>
<tr>
<td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
</tr>
</table>
<p><input type="submit" name="confirm" value="Bomb Sadam"> or alternatively
<a href="/user.php">Get the Hell out of Here</a></p>
</form>
</body>
</html>
