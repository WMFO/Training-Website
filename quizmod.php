<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
if ($_SESSION['role'] != "admin") {
  header("Location: index.php");
}
$sql = "SELECT * FROM quiz_questions ORDER BY qnum ASC";
$result = $conn->query($sql);
?>
<html>
<head>
<title>Quiz Management</title>
</head>
<body>
<h1>Quiz Management</h1>
<p>Here you will find a list of the quiz items. You may freely add, remove, rearrange, etc.</p>
<p>The order number is sorted ascending, so to change the order simply change the listed numbers and then hit update below. If you wish to swap question numbers, please change one number high (eg 999) and then swap. Modification and delete links are to the right of each item, while the add new item link is at the bottom. Enjoy!</p>
<p><a href="quiz_person.php">Reset People's Quiz View</a></p>
  <form method="post" action="" name="neh">
<table border="2">
<tr>
<th>Question Number</th>
<th>Item</th>
<th>Input</th>
<th>Modify</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['qnum']; ?></td>
<td><?php echo $row['content'];?></td>
<td><?php echo $row['input'];?></td>
<td><a href="quiz_item_mod.php?item=<?php echo $row['id']; ?>">Modify</a> <a href="delquiz.php?item=<?php echo $row['id']; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
</form>
<p><a href="quiz_item_mod.php">Add New Item</a></p>
<a href="index.php">Home</a>
</body>
</html>
