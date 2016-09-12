<?php
require_once("./includes/session_timeout.inc.php");
include('./includes/logout.inc.php');
if($_SESSION['role'] != 'admin'){
   header('Location: index.php');
}
include("./includes/session_var_setup.inc.php");
if(isset($_POST['globalreset']) && strtoupper(@$_POST['supersure']) == "DELETE"){
  $date = date("Y-m-d_His");
  exec("mysqldump -u training -ptraining training > backups/${date}.sql");
  if (filesize("backups/${date}.sql") < 5)
    die("the backup failed -- backup size is quite small, which is bad. Please fix the code.");
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
  $sql = "ALTER TABLE quiz_answers AUTO_INCREMENT = 1";
  $connw->query($sql);
}
if (isset($_POST['restore'])) {
  $date = date("Y-m-d_His");
  exec("mysqldump -u training_coordin -ptraining_wmfo -h mysql.wmfo.org wmfo_training > backups/restore_${date}.sql");
  $backups = opendir("backups/");
    while (false !== ($entry = readdir($backups))) {
        if (strpos($entry,".sql") && $_POST['which'] == $entry)
	  $restorefile = $entry;
    }  
  if (!isset($restorefile)) {
    die("Invalid restore filename");
  }
  exec("mysql -u training_coordin -ptraining_wmfo -h mysql.wmfo.org wmfo_training < backups/$restorefile");
}
if (isset($_POST['activate'])){
  require("./includes/usernable.inc.php");
}
$sql = "SELECT * FROM users WHERE role != 'admin'";
$result = $conn->query($sql);
include('./head.inc.php');

?>
<h1>The Alimighty User Management Page</h1>
<p>Below is a list of users. Users are active when they sign up (the key ensures that random ruffians do not wander into the system). You may disable or delete a user, or you may select extended registration to allow them to choose a show before or after the typical deadline.</p>
<p>Press modify to change user type, attributes, or registration status (if they're a trainee).</p>
<p>Any trainer set to "ER" will see a "Make-up week" attendance column. Please set this if you are running a make up lesson.</p>
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
<p>This will also simultaneously create a backup so that the site can be restored (manually) to the previous condition. However, if that backup were to fail...that would mean...well...</p>
<form name="resetform" action="" method="post">
<p>
<label for="globalreset">I want to destroy all users</label>
<input type="checkbox" id="globalreset" name="globalreset">
</p>
<p>
<label for="supersure">If I'm super sure I want to do this, I'll type <b>delete</b> in this box:</label>
<input type="textarea" maxlength="6" name="supersure" id="supersure">
</p>
<p>
<input type="submit" value="Delete All Users" name="reset">
</p>
</form>
<h2>Global Restore</h2>
<p>This section allows you to restore to various times. The dropdown will select the various dates, and your site will be restored to that point in time. All data (including quiz etc) will be restored.</p>
<p>
<form action="" method="post">
<label for="which">Date:</label>
<select name="which" id="which">
<?php
$backups = opendir("backups/");
    while (false !== ($entry = readdir($backups))) {
	if (strpos($entry,".sql"))
          echo "<option name='$entry'>$entry</option>\n";
    }?>
</select>
</p>
<p>
<input type="submit" name="restore" value="Restore">
</form>
</p>
<?php include('./tail.inc.php');?>
