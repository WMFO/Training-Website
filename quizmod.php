<?php
if($_SESSION['role'] != 'admin'){
     header('Location: index.php');
}
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
if (isset($_POST['reorder']) && $role == "admin") {
  require("./includes/checkorder.inc.php");
}
$sql = "SELECT * FROM quiz_questions ORDER BY qnum ASC";
$result = $conn->query($sql);
include('./head.inc.php');
?>
<h1>Checklist Management</h1>
<p>Here you will find a list of the checklist items. You may freely add, remove, rearrange, etc.</p>
<p>The order number is sorted ascending, so to change the order simply change the listed numbers and then hit update below. Modification and delete links are to the right of each item, while the add new item link is at the bottom. Enjoy!</p>
<?php if ($role == "admin") {?>
  <form method="post" action="" name="reorder">
<?php } else {?>
<p>This page details the checklist items for all weeks. Make sure you've covered all of these if you're doing a make up lesson.</p>
<?php } ?>
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
<?php  
include('./tail.inc.php');?>
