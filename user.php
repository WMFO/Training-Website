<?php
require_once("./includes/session_timeout.inc.php");
include('./includes/logout.inc.php');
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}
include("./includes/session_var_setup.inc.php");
if(isset($_POST['globalreset']) && @$_POST['supersure'] == 3){
  $sql = "DELETE FROM users WHERE role != 'admin'";
  $connw=dbConnect('write');
  $connw->query($sql);
  $sql = "DELETE FROM attendance";
  $connw->query($sql);
  $sql = "DELETE FROM checklist_completion";
  $connw->query($sql);
  $sql = "DELETE FROM quiz_answers";
  $connw->query($sql);
  $sql = "DELETE FROM quiz_views";
  $connw->query($sql);
}
if (isset($_POST['activate'])){
  require("./includes/usernable.inc.php");
}
$sql = "SELECT * FROM users WHERE role != 'admin'";
$result = $conn->query($sql);
include('./head.inc.php');

?>
<h1>The Alimighty User Management Page</h1>
<p>Below is a list of users. Users are active when they sign up (the key ensures that random ruffians do not wander into the system). You may disabled or delete a user, or you may select early registration to allow them to choose a show before the typical deadline.</p>
<p><b>In order to set make-up show,</b> set all candidates to the "Make-up Show," as well as the trainer who will be teaching. Any trainers which are disabled will not show up in registration results, but obviously you should not lock anyone out before their show has completed.</p>
<p>Once you have selected the DJ as a make-up lesson teacher, press the "boot" button to kick all DJs (who have completed their training) out of the list. But be careful, Nick will not fix your mistakes.</p>
<form name="usermanform" method="post" action="">
<table border="2">
<tr>
<th>Mod/Delete</th>
<th>Info</th>
<th>Setup</th>
</tr>
<?php
while ($row = $result->fetch_assoc()){
?>
<tr>
<td><a href="moduser.php?user=<?php echo $row['user_id'];?>">MOD</a> or
 <a href="deluser.php?user=<?php echo $row['user_id'];?>">DEL</a></td>
<td><?php echo $row['fname'] . ' ' . $row['lname']; ?>
<br /><?php echo $row['email'];?></td>
   <td>D<input type="radio" name="<?php echo $row['user_id'];?>" value="0"
<?php if ($row['enabled'] == 0) {echo "checked";} ?>>
   E<input type="radio" name="<?php echo $row['user_id'];?>" value="1"
   <?php if ($row['enabled'] == 1) {echo "checked";} ?>>
   ER<input type="radio" name="<?php echo $row['user_id'];?>" value="2"
   <?php if ($row['enabled'] == 2) {echo "checked";} ?>></td>
</tr>
<?php } ?>
</table>
<p><input type="submit" value="Set User Activation" name="activate"></p>
<p><a href="index.php">Home</a></p>
</form>
<h2>The Global Reset</h2>
<p>The following button will delete all trainees and trainers in preparation for the next training session. This change is permanent and unrecoverable. Don't complain to Nick if you accidentally push this button when it is not appropriate to do so. Thanks.</p>
<form name="resetform" action="" method="post">
<p>
<label for="globalreset">I want to destroy all users</label>
<input type="checkbox" id="globalreset" name="globalreset">
</p>
<p>
<label for="supersure">If I'm super sure I want to do this, I'll put a 3 in this box:</label>
<input type="textarea" maxlength="1" name="supersure">
</p>
<p>
<input type="submit" value="Delete All Users" name="reset">
</p>
</form>
<?php include('./tail.inc.php');?>
