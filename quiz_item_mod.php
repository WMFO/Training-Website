<?php
if(isset($_GET['item']) && !is_numeric($_GET['item'])){
  die("you dunderfuck. item should be numeric.");
}
$mod = isset($_GET['item']);
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$connw = dbConnect('write');
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}
if(isset($_POST['update'])){
  $description = addslashes($_POST['itemval']);
  $qnum = intval($_POST['qnum']);
  $input = intval($_POST['weeknum']);
  $postname = $connw->real_escape_string($_POST['postname']);
  if ($mod) {
    $sql = 'UPDATE quiz_questions SET content = "' . $description . '", qnum = ' . $qnum 
      . ', weeknum = ' . $weeknum . " WHERE id = " . $_GET['item'];
  } else {
    $sql = 'INSERT INTO quiz_questions (content, input, postname, qnum,'
    . 'answer, answer_type) VALUES ("' . $item 
      . '", ' . $onum . ", " . $weeknum . ")";
  }
  $test4 = $connw->query($sql);
  if ($test4) {
  header('Location: checklist.php');
  }
}


?>
<html>
<head>
<title="Modify Quiz Item">
</head>
<body>
<h1>Quiz Item </h1>
<p>Use the form below to populate, then hit update when you're done.</p>
<?php
if ($mod) {
$sql = "SELECT * FROM checklist WHERE id = " . $_GET['item'];
$check = $connw->query($sql);
$row = $check->fetch_assoc(); 
}
?>
<form method="post" action="" name="confirmitemdel">
<?php if ($mod) { ?>
<input type="hidden" name="idnum" value="<?php echo $_GET['item']; ?>">
<?php } ?>
<table border="2">
<tr>
<th>Item</th>
<td><textarea name="itemval" cols="60" rows="10"><?php
if (isset($_GET['item'])){ echo $row['item']; }?></textarea></td>
</tr>
<tr>
<th>Order Number</th>
<td><input type="text" maxlength="3" size="4" name="onum"<?php if (isset($_GET['item'])){?>value="<?php echo $row['onum'];?>"<?php } ?>></td>
</tr>
<tr>
<th>Week Number</th>
<td><input type="text" maxlength="1" size="2" name="weeknum"<?php if (isset($_GET['item'])){?>value="<?php echo $row['weeknum'];?>"<?php } ?>></td>
</tr>
</table>
<p><input type="submit" name="update" value="Update Item"> or alternatively
<a href="checklist.php">Get the Hell out of Here</a></p>
</form>
</body>
</html>
