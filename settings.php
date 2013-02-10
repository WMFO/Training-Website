<?php
include('./includes/logout.inc.php');
date_default_timezone_set('America/New_York');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
if (isset($_POST['settingsubmit'])){
  require("./includes/settingupdate.inc.php");
}
$connw = dbConnect('write');
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}
$sql = "SELECT * FROM settings";
$result = $connw->query($sql);
include('./head.inc.php');
?>
<link rel="stylesheet" type="text/css" href="./includes/anytime.c.css" />
<script src="./includes/jquery.min.js"></script>
<script src="./includes/anytime.c.js"></script>
<h1>Settings Page</h1>
<br />
<table><tr><td>
<p>Here you can configure settings. Non-date values are restricted to integers of length 7. Please don't stuff other things than that into them or bad things will happen. Since you're the training coordinator/authorized person, I trust you. Nick will not fix your mistakes.</p>
</td></tr></table>
<form name="settings" method="post" action="">
<table border="2">
<?php while ($row = $result->fetch_assoc()){?>
<tr>
<td><b><?php echo $row['name']; ?></b></td>
<td><?php
if ($row['type'] == "int"){
  echo '<input type="text" name="' . $row['name'] . '" id="' . $row['name'] . 
    '"  value="' . $row['nvalue'] . '" maxchars="7">';
} elseif ($row['type'] == "date") {
  echo '<input type="text" name="' . $row['name'] . '" id="' . $row['name'] 
    . '" value="' . $row['dvalue'] . '"/>';?>
<script>
  AnyTime.picker( "<?php echo $row['name']; ?>",
{ format: "%Y-%m-%d %T", firstDOW: 1 } );
</script>
<?php } ?> 
</td>
<td><?php echo $row['Description']; ?></td>
</tr>
<?php } ?>
</table>
<br />
<h2>Text Editing</h2>
<p>This area allows customization of the side bar. Please compare what appears at your right with the text inside. To modify, simply change the text. It is coded with basic HTML and CSS tags which you can research if you want. To make a new line, copy and paste an existing line. Pretty simple.</p>
<table border="2">
<?php
  $sql = "SELECT * FROM cmstext";
  $text = $connw->query($sql);
  while ( $item = $text->fetch_assoc()) {
?><tr>
  <th><?php echo $item['name'];?></th>
  <td><textarea name="<?php echo $item['name']; ?>" rows="8" cols="40"><?php
    echo $item['body']; ?></textarea></td>
  <td><?php echo $item['description'];?></td>
</tr>
<?php } ?>
</table>

<p><input type="submit" name="settingsubmit"></p>
</form>
<i><font color="grey">For a sanity check, the current time is <?php echo strftime("%c" , time()); ?></font></i>
<?php include('./tail.inc.php'); ?>
