<?php
require_once("./includes/session_timeout.inc.php");
//require("./includes/session_var_setup.php");

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
<p>Your registration and login is successful. Please log back in at the appropriate time to select your show. Resources are below.</p>
<?php include("./includes/show_selection.inc.php");
?>
<?php
}
?>

<?php 
if($_SESSION['role'] == "trainer"){
?>
<h1>Training Management Portal</h1>
<p>Thanks for registering! Once the DJs have registered you'll be able to see their names and contact info below. Please take attendence and fill out this checklist every week during your show!</p>
<?php } ?>
You've logged in. Still working on this part.
