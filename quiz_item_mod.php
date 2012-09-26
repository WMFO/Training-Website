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
  $input = $connw->real_escape_string($_POST['input']);
  $postname = $connw->real_escape_string($_POST['postname']);
  $answer = $connw->real_escape_string($_POST['answer']);
  if ($mod) {
    $sql = 'UPDATE quiz_questions SET content = "' . $description . '", qnum = ' . $qnum 
      . ', input = "' . $input
      . '", post_name = "' . $postname . '", answer = "' . $answer
      . '" WHERE id = ' . $_GET['item'];
  } else {
    $sql = 'INSERT INTO quiz_questions (content, input, post_name, qnum,'
    . 'answer) VALUES ("' . $description . '", "' . $input . '", "' . $postname
      . '", ' . $qnum . ', "' . $answer . '")';
  }
  $test4 = $connw->query($sql);
  if ($test4) {
  header('Location: quizmod.php');
  } else {
    $error = "You done fucked up: No two questions may share the same number.";
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
echo @$error;
if ($mod) {
$sql = "SELECT * FROM quiz_questions WHERE id = " . $_GET['item'];
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
<th>Question Number</th>
<td><input type="text" maxlength="3" size="4" name="qnum"<?php if (isset($_GET['item'])){?>value="<?php echo $row['qnum'];?>"<?php } ?>></td>
</tr>
<tr>
<th>Question HTML</th>
<td><textarea name="itemval" cols="60" rows="10"><?php
if (isset($_GET['item'])){ echo $row['content']; }?></textarea></td>
</tr>
<tr>
<th>Input HTML</th>
<td><textarea name="input"i cols="60" rows="10">
<?php if (isset($_GET['item'])){ echo $row['input']; } ?>
</textarea></td>
</tr>
<tr>
<th>Post Name</th>
<td><input type="text" name="postname" value="<?php if(isset($_GET['item'])){ echo $row['post_name']; }?>">
</tr>
<tr>
<th>Answer</th>
<td><input type="text" name="answer" value="<?php if(isset($_GET['item'])){ echo $row['answer']; }?>">
</tr>
</table>
<p><input type="submit" name="update" value="Update Item"> or alternatively
<a href="quizmod.php">Get the Hell out of Here</a></p>
</form>
</body>
</html>
