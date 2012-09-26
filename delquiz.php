<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$connw = dbConnect('write');
if(isset($_POST['confirm'])){
  $sql = "DELETE FROM quiz_questions WHERE id = " . $_GET['item'];
  $connw->query($sql);
  header('Location: quizmod.php');
}
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}

?>
<html>
<head>
<title="Delete Quiz Item???">
</head>
<body>
<h1>Really Delete Item Below?</h1>
<p>This change is permanent and unrecoverable. If you screw this up, Nick is not going to help you fix it.</p>
<?php
$sql = "SELECT * FROM quiz_questions WHERE id = " . $_GET['item'];
$user = $connw->query($sql);
?>
<form method="post" action="" name="confirmitemdel">
<table border="2">
<tr>
<th>Item</th>
</tr>
<?php
$row = $user->fetch_assoc(); ?>
<tr>
<td><?php echo $row['content']; ?></td>
</tr>
</table>
<p><input type="submit" name="confirm" value="Bomb Sadam"> or alternatively
<a href="quizmod.php">Get the Hell out of Here</a></p>
</form>
</body>
</html>
