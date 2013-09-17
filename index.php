<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
include('./includes/logout.inc.php');
date_default_timezone_set('America/New_York'); 
include('./head.inc.php');
if($_SESSION['role'] == "admin"){
  ?>
<h1>Admin Area</h1>
<h3><i>How baller is that?</i></h3>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>
<p>
<a href="emailqueries.php">Run Email Queries</a>
</p><p><a href="upload.php">Upload Files</a>
</p>
<?php 
include('./includes/stats.inc.php');} 
if($_SESSION['role'] == "trainee"){
  include('./includes/trainee_page.inc.php');
}
?>

<?php 
if($_SESSION['role'] == "trainer"){
?>
<h1>Training Management Portal</h1>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>
<?php if (!$registration_done) { ?>
<p>You've successfully registered for TEMS! Please remember the following points:</p>
<ul><li>Once people register for your show, they'll be visible below.</li>
<li>Check back after the registration period ends (see sidebar for dates) and email all the members of your show per the instructions of the training coordinator.</li>
<li>Remember to take attendance and fill out the checklist every week!</li></ul>
<?php } ?>

<?php include('./includes/trainer_startpage.inc.php'); ?>

<?php  include('./includes/checklist.inc.php');
} ?>
<p><br>Problems? Email training@wmfo.org.</p>
<?php include('./tail.inc.php');
