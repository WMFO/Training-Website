<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
$role = $_SESSION['role'];
if (isset($_POST['reorder']) && $role == "admin") {
  require("./includes/checkorder.inc.php");
}
$sql = "SELECT * FROM checklist ORDER BY onum ASC";
$result = $conn->query($sql);
?>
<html>
<head>
<title="Checklis">
</head>
<body>
<h1>Checklist Management</h1>
<?php if ($role == "admin") {?>
  <form method="post" action="" name="reorder">
<?php } else {?>
<p>This page details the checklist items for all weeks. Make sure you've covered all of these if you're doing a make up lesson.</p>
<?php } ?>
<table border="2">
<tr>
<th>Weeknumber</th>
<?php if ($role == "admin") { echo "<th>Order Number</th>";}?>
<th>Item</th>
<?php if ($role == "admin") { echo "<th>Modify</th>";}?>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['weeknum']; ?></td>
<?php if ($role == "admin") { ?>
<td><input type="text" size="3" name="<?php echo $row['id'];?>"
value="<?php echo $row['onum']; ?>"></td>
<?php } ?>
<td><?php echo $row['item'];?></td>
<?php if ($role == "admin") {?>
<td><a href="modcheck.php?item=<?php echo $row['id']; ?>">Modify</a> <a href="delcheck.php?item=<?php echo $row['id']; ?>">Delete</a></td>
<?php } ?>
</tr>
<?php } ?>
</table>
<?php if ($role == "admin") {?>
<p><input type="submit" name="reorder" value="Change Order"></p>
</form>
<p><a href="modcheck.php">Add New Item</a></p>
<?php } ?>
<p><a href="/">Home</a></p>
</body>
</html>
