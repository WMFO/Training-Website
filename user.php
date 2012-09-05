<?php
require_once("./includes/session_timeout.inc.php");
if($_SESSION['role'] != 'admin'){
   header('Location: /index.php');
}
include("./includes/session_var_setup.inc.php");
if (isset($_POST['activate'])){
  require("./includes/usernable.inc.php");
}
$sql = "SELECT * FROM users WHERE role != 'admin'";
$result = $conn->query($sql);

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
<p>Below is a list of users. Users are active when they sign up (the key ensures that random ruffians do not wander into the system). You may disabled or delete a user, or you may select early registration to allow them to choose a show before the typical deadline.</p>
<form name="usermanform" method="post" action="">
<table border="2">
<tr>
<th>Delete</th>
<th>Name</th>
<th>Email</th>
<th>Type</th>
<th>Show Name</th>
<th>Show Time/Day</th>
<th>Disabled</th>
<th>Enabled</th>
<th>Extended Registration/Add Drop</th>
</tr>
<?php
while ($row = $result->fetch_assoc()){
?>
<tr>
<td><a href="deluser.php?user=<?php echo $row['user_id'];?>">DEL</a></td>
<td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['role']; ?></td>
<td><?php echo $row['showname']; ?></td>
<td><?php
 if($row['role'] == 'trainer'){ echo $row['showduration'] . 'hrs ' . $row['showday'] . ' '
   . $row['showtime'] . $row['showpm'];
 }?></td>
   <td>D<input type="radio" name="<?php echo $row['user_id'];?>" value="0"
<?php if ($row['enabled'] == 0) {echo "checked";} ?>></td>
   <td>E<input type="radio" name="<?php echo $row['user_id'];?>" value="1"
   <?php if ($row['enabled'] == 1) {echo "checked";} ?>></td>
   <td>ER<input type="radio" name="<?php echo $row['user_id'];?>" value="2"
   <?php if ($row['enabled'] == 2) {echo "checked";} ?>></td>
</tr>
<?php } ?>
</table>
<p><input type="submit" value="Set User Activation" name="activate"></p>
<p><a href="/">Home</a></p>
</form>
</body>
</html>
