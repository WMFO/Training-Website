<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
require_once("./includes/connection.inc.php");
if (isset($_POST['settingsubmit'])){
  require("./includes/settingupdate.inc.php");
}
$connw = dbConnect('write');
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}
$sql = "SELECT showduration FROM users WHERE role = 'trainer'";
$result = $connw->query($sql);

?>
<html>
<head>
<title="Settings Management">
</head>
<body>
<h1></h1>
<table width="400px"><tr><td>
<h1>Statistics Page</h1>
<p>This stats page provides basic information, including alerts about incomplete checklists and missing attendance.</p>
</td></tr></table>
<table border="2">
<tr><td>Number 1 hour shows:</td>
<td><?php
$show1hr = 0;
$show2hr = 0;
while($row = $result->fetch_assoc()){
  if($row['showduration'] == 1) {
    $show1hr++;
  } else {
    $show2hr++;
  }
}
echo $show1hr;
?></td></tr>
<tr><td>Number 2 hour shows:</td>
<td><?php echo $show2hr;?></td>
</tr>
<tr>
<td>Max Capacity</td>
<td><?php echo $setting['max1hour'] * $show1hr
+ $setting['max2hour'] * $show2hr;?></td>
</tr>
<tr><td>Enrolled Students</td>
<td><?php
$result->close();
$sql = "SELECT user_id FROM users WHERE role = 'trainee'";
$result = $connw->query($sql);
echo $result->num_rows;

?></td></tr>

</table>
<p><a href="/">Home</a></p>
</body>
</html>
