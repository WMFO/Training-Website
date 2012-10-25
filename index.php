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
<p>You can view DJ names and contact info below once they join your show. Please take attendance and fill out the checklist every week during your show!</p>

<?php include('./includes/trainer_startpage.inc.php'); ?>

<?php  include('./includes/checklist.inc.php');
} ?>
<p>Problems? Email training@wmfo.org.</p>
<?php include('./tail.inc.php');
