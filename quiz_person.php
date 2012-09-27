<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
if ($_SESSION['role'] != "admin") {
  header("Location: index");
}
if (isset($_POST['resetviews']) && $_SESSION['role'] == "admin") {
  foreach($_POST['delview'] as $person) {
    $sql2 = "DELETE FROM quiz_views WHERE id_fk = " . $person;
    $conn->query($sql2);
  }
}
$sql = "SELECT fname, lname, email, user_id, quizscore FROM quiz_views LEFT JOIN users on user_id = id_fk";
$result = $conn->query($sql);
?>
<html>
<head>
<title>Quiz Views</title>
</head>
<body>
<h1>Quiz Management</h1>
<p>Here you will find a list of the quiz items. You may freely add, remove, rearrange, etc.</p>
  <form method="post" action="" name="meh">
<table border="2">
<tr>
<th>Person</th>
<th>Email</th>
<th>Quiz Score</th>
<th>Reset</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['quizscore'];?></td>
<td><input type="checkbox" name="delview[]" value="<?php echo $row['user_id']; ?>"></td>
</tr>
<?php } ?>
</table>
<input type="submit" name="resetviews" value="Reset Quiz Views">
</form>
<a href="index.php">Home</a>
</body>
</html>
