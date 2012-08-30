<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");

if($_SESSION['role'] == "admin"){
  ?>
<h1>Admin Area</h1>
<h3><i>How balller is that?</i></h3>
<p><a href="user.php">User Management</a></p>

<p><a href="checklist.php">Checklist Management</a></p>
<p><a href="settings.php">Settings Management</a></p>
<p><a href="stats.php">Stats</a></p>

<?php } ?>
<?php
if($_SESSION['role'] == "trainee"){
?>
<h1>Trainee Area</h1>
<?php if (!$register) {?><p>Your registration and login is successful. Please log back in at the appropriate time to select your show.</p>
<?php } else { ?>
<p>Welcome to the WMFO training portal.</p>
<?php }
include("./includes/show_selection.inc.php");

?>
<?php
}
?>

<?php 
if($_SESSION['role'] == "trainer"){
?>
<h1>Training Management Portal</h1>
<p>Welcome! You can view DJ names and contact info below. Please take attendence and fill out the checklist every week during your show!</p>

<?php include('./includes/trainer_startpage.inc.php'); ?>
<h2>Weekly Training Checklist</h2>

<?php  include('./includes/checklist.inc.php');
} ?>
<p>You're currently logged in.</p>
<?php include('./includes/logout.inc.php'); ?>
<p>Problems? Email training@wmfo.org.</p>
