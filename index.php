<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
date_default_timezone_set('America/New_York'); 

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
<a href="moduser.php">Modify User Settings</a>
<?php
}
?>

<?php 
if($_SESSION['role'] == "trainer"){
?>
<h1>Training Management Portal</h1>
<?php if(0) {?>
<table border="2" width="400px">
<tr><td style="background-color: yellow"><b>Notice:</b> WMFO is transitioning to a two (2) week training time frame to enhance overall efficiency of the training process. The Fall 2012 training will be a trial run of the new system. To facilitate the shorter timeframe, we will also be using the TEMS, a training management infrastructure for keeping track of attendance and training goals. If you have any questions, feel free to ask via email.</td></tr>
</table>
<?php } ?>
<p>Welcome! You can view DJ names and contact info below once they join your show. Please take attendence and fill out the checklist every week during your show!</p>

<?php include('./includes/trainer_startpage.inc.php'); ?>

<?php  include('./includes/checklist.inc.php');
?><a href="moduser.php">Modify User Settings</a> <?php
} ?>
<?php include('./includes/logout.inc.php'); ?>
<p>Problems? Email training@wmfo.org.</p>
<font color="grey"><p>The WMFO Training Education Management System (the TEMS&reg;)<br>
<i>It's like SIS, but not terrible.</i><br>
&copy; Nicholas Andre <?php echo date("Y"); ?></p></font>
