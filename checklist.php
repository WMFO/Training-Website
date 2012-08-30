<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
if($_SESSION['role'] != 'admin'){
   header('Location: /index.php');
}
if (isset($_POST['reorder'])) {
  require("./includes/checkorder.inc.php");
}
$sql = "SELECT * FROM checklist ORDER BY onum ASC";
$result = $conn->query($sql);
?>
<html>
<head>
<link rel="stylesheet" type="test/css" href="./includes/anytime.c.css" />
<script src="./includes/jquery.js"></script>
<script src="/anytime.c.js"></script>
<title="Settings Management">
</head>
<body>
<h1>Checklist Management</h1>
<form method="post" action="" name="reorder">
<table border="2">
<tr>
<th>Weeknumber</th>
<th>Order Number</th>
<th>Item</th>
<th>Modify</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['weeknum']; ?></td>
<td><input type="text" size="3" name="<?php echo $row['id'];?>"
value="<?php echo $row['onum']; ?>"></td>
<td><?php echo $row['item'];?></td>
<td><a href="modcheck.php?item=<?php echo $row['id']; ?>">Modify</a> <a href="delcheck.php?item=<?php echo $row['id']; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
<p><input type="submit" name="reorder" value="Change Order"></p>
</form>
<p><a href="modcheck.php">Add New Item</a></p>
<p><a href="/">Home</a></p>
</body>
</html>
